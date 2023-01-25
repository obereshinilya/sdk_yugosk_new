
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is parsing database XML configuration file.
    Configuration file name sumcheckerconfig.xml

    Config file example

    <?xml version="1.0" encoding="UTF-8"?>
    <SumChecker Version="0.100">

        <pgserver host = "172.16.205.128" port = "5432" database = "postgres" user = "postgres" passwd = "postgres"/>   <!-- Connection parameters -->
        <algorithm>Sha256</algorithm>
        <logtype>file_and_database</logtype>

    </SumChecker>

    algorithm type variants:

    Md4         Generate an MD4 hash sum
    Md5         Generate an MD5 hash sum
    Sha1        Generate an SHA-1 hash sum
    Sha224      Generate an SHA-224 hash sum (SHA-2). Introduced in Qt 5.0
    Sha256      Generate an SHA-256 hash sum (SHA-2). Introduced in Qt 5.0
    Sha384      Generate an SHA-384 hash sum (SHA-2). Introduced in Qt 5.0
    Sha512      Generate an SHA-512 hash sum (SHA-2). Introduced in Qt 5.0
    Sha3_224	Generate an SHA3-224 hash sum. Introduced in Qt 5.1
    Sha3_256	Generate an SHA3-256 hash sum. Introduced in Qt 5.1
    Sha3_384	Generate an SHA3-384 hash sum. Introduced in Qt 5.1
    Sha3_512	Generate an SHA3-512 hash sum. Introduced in Qt 5.1


    logtype variants:

    file
    database
    file_and_database

******************************************************************************/

#ifndef CONFIGFILEPARSER_H
#define CONFIGFILEPARSER_H

#include <QObject>
#include <sumcheckertypes.h>


class QDomNode;
class QDateTime;
class Logger;


class ConfigFileParser : public QObject
{
    Q_OBJECT
public:
    explicit ConfigFileParser(QObject *parent = nullptr);
    ~ConfigFileParser();

    bool parse(ApplicationConfig &appConf);
    void setLogger(Logger *logger);


private:

    bool parseNode(const QDomNode& node, ApplicationConfig &appConf);
    QCryptographicHash::Algorithm selectAlgorithm(const QString &algorithmStr) const;
    void initAlgorithmHash();

    QDateTime *m_dateTime;
    QHash<QString, QCryptographicHash::Algorithm> *m_algorithmHash;
    Logger *m_Logger;



signals:

};

#endif // CONFIGFILEPARSER_H
