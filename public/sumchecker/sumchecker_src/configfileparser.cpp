#include "configfileparser.h"
#include <QDateTime>
#include <qt5/QtXml/QDomDocument>
#include <QFile>
#include <qt5/QtXml/QDomElement>
#include <iostream>
#include <QHash>
#include <logger.h>
#include "datavalidator.h"


//****************************************************************************

ConfigFileParser::ConfigFileParser(QObject *parent) : QObject(parent)
{
    m_dateTime = new QDateTime();
    m_algorithmHash = new QHash<QString, QCryptographicHash::Algorithm>();
    initAlgorithmHash();
}

//****************************************************************************

ConfigFileParser::~ConfigFileParser()
{
    if(m_dateTime != NULL)
    {
        delete m_dateTime;
        m_dateTime = NULL;
    }
    if(m_algorithmHash != NULL)
    {
        delete m_algorithmHash;
        m_algorithmHash = NULL;
    }
}

//****************************************************************************

bool ConfigFileParser::parse(ApplicationConfig &appConf)
{
    QDomDocument domDoc;
    QFile file (configFilePath);
    QString errParceStr;
    int errRow;
    int errColumn;
    bool isParseOk = false;

    if(file.open(QIODevice::ReadOnly))
    {
        if(domDoc.setContent(&file, &errParceStr, &errRow, &errColumn))
        {
            QDomElement domElement = domDoc.documentElement();
            if(parseNode(domElement, appConf))
                isParseOk = true;
            else
                isParseOk = false;
        }
        else
        {
            isParseOk = false;
        }
        file.close();

    }
    else
    {
        QString error = "Error open config file!\n";
        std::cerr << error.toUtf8().data();
    }

    return isParseOk;
}


//****************************************************************************
//"postgresql://postgres:postgres@172.16.205.128:5432/postgres"

bool ConfigFileParser::parseNode(const QDomNode& node, ApplicationConfig &appConf)
{
    QDomNode domNode = node.firstChild();
    while (!domNode.isNull())
    {
        if(domNode.isElement())
        {
            QDomElement domElement = domNode.toElement();
            if (!domElement.isNull())
            {
                if (domElement.tagName() ==  "pgserver")
                {

                    appConf.DBPath = QString("postgresql://") + domElement.attribute ("user" , "")
                            + QString(":") + domElement.attribute ("passwd" , "") + QString("@") + domElement.attribute ("host" , "")
                            + QString(":") + domElement.attribute ("port" , "") + QString("/") + domElement.attribute ("database" , "");

                    std::cerr << "\nConnect string: " << appConf.DBPath.toUtf8().data() << "\n";
                }
                else if(domElement.tagName() ==  "algorithm")
                {
                    if(!DataValidator::validateAlgorithmType(domElement.text()))
                    {
                        return false;
                    }
                    QString tmpStr;
                    appConf.hashAlgorithm = selectAlgorithm(domElement.text());
                    tmpStr = domElement.text();
                    std::cerr << "algorithm: " << tmpStr.toUtf8().data() << "\n";
                }
                else if(domElement.tagName() ==  "logtype")
                {
                    if(!DataValidator::validateLogType(domElement.text()))
                    {
                        return false;
                    }
                    QString tmpStr = "";
                    if(domElement.text() == "file")
                    {
                       appConf.logType = HD_FILE;
                       tmpStr = "LogFile";
                    }
                    else if(domElement.text() == "database")
                    {
                       appConf.logType = DATABASE;
                       tmpStr = "LogDB";
                    }
                    else if(domElement.text() == "file_and_database")
                    {
                       appConf.logType = FILE_AND_DATABASE;
                       tmpStr = "LogFileAndDB";
                    }
                    else
                    {
                        std::cerr << "\nError in config file!\n";
                    }

                    std::cerr << "logtype: " << tmpStr.toUtf8().data() << "\n";
                 }
            }
        }
        parseNode(domNode, appConf);
        domNode = domNode.nextSibling();
    }
    return true;
}

//****************************************************************************

QCryptographicHash::Algorithm ConfigFileParser::selectAlgorithm(const QString &algorithmStr) const
{
    return m_algorithmHash->value(algorithmStr);
}

//****************************************************************************

/*QCryptographicHash::Md4	0	Generate an MD4 hash sum
QCryptographicHash::Md5	1	Generate an MD5 hash sum
QCryptographicHash::Sha1	2	Generate an SHA-1 hash sum
QCryptographicHash::Sha224	3	Generate an SHA-224 hash sum (SHA-2). Introduced in Qt 5.0
QCryptographicHash::Sha256	4	Generate an SHA-256 hash sum (SHA-2). Introduced in Qt 5.0
QCryptographicHash::Sha384	5	Generate an SHA-384 hash sum (SHA-2). Introduced in Qt 5.0
QCryptographicHash::Sha512	6	Generate an SHA-512 hash sum (SHA-2). Introduced in Qt 5.0
QCryptographicHash::Sha3_224	RealSha3_224	Generate an SHA3-224 hash sum. Introduced in Qt 5.1
QCryptographicHash::Sha3_256	RealSha3_256	Generate an SHA3-256 hash sum. Introduced in Qt 5.1
QCryptographicHash::Sha3_384	RealSha3_384	Generate an SHA3-384 hash sum. Introduced in Qt 5.1
QCryptographicHash::Sha3_512	RealSha3_512	Generate an SHA3-512 hash sum. Introduced in Qt 5.1
QCryptographicHash::Keccak_224	7	Generate a Keccak-224 hash sum. Introduced in Qt 5.9.2
QCryptographicHash::Keccak_256	8	Generate a Keccak-256 hash sum. Introduced in Qt 5.9.2
QCryptographicHash::Keccak_384	9	Generate a Keccak-384 hash sum. Introduced in Qt 5.9.2
QCryptographicHash::Keccak_512	10	Generate a Keccak-512 hash sum. Introduced in Qt 5.9.2*/

void ConfigFileParser::initAlgorithmHash()
{

    m_algorithmHash->insert("Md4", QCryptographicHash::Md4);
    m_algorithmHash->insert("Md5", QCryptographicHash::Md5);
    m_algorithmHash->insert("Sha1", QCryptographicHash::Sha1);
    m_algorithmHash->insert("Sha224", QCryptographicHash::Sha224);
    m_algorithmHash->insert("Sha256", QCryptographicHash::Sha256);
    m_algorithmHash->insert("Sha384", QCryptographicHash::Sha384);
    m_algorithmHash->insert("Sha512", QCryptographicHash::Sha512);
    m_algorithmHash->insert("Sha3_224", QCryptographicHash::Sha3_224);
    m_algorithmHash->insert("Sha3_256", QCryptographicHash::Sha3_256);
    m_algorithmHash->insert("Sha3_384", QCryptographicHash::Sha3_384);
    m_algorithmHash->insert("Sha3_512", QCryptographicHash::Sha3_512);
    m_algorithmHash->insert("Keccak_224", QCryptographicHash::Keccak_224);
    m_algorithmHash->insert("Keccak_256", QCryptographicHash::Keccak_256);
    m_algorithmHash->insert("Keccak_384", QCryptographicHash::Keccak_384);
    m_algorithmHash->insert("Keccak_512", QCryptographicHash::Keccak_512);

}

//****************************************************************************

void ConfigFileParser::setLogger(Logger *logger)
{
    m_Logger = logger;
}

//****************************************************************************
