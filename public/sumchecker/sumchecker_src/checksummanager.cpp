#include "checksummanager.h"
#include <checksumcalculator.h>
#include <dbmanager.h>
#include <checksumcalculator.h>
#include <QFile>
#include <iostream>
#include <logger.h>


ChecksumManager::ChecksumManager(QObject *parent) : QObject(parent)
{
    m_checksumCalc = NULL;
    errorCnt = 0;
}

//*******************************************************************************************

ChecksumManager::~ChecksumManager()
{

}

//*******************************************************************************************

bool ChecksumManager::prepare()
{
    QFile checkFile;
    QByteArray hashSum;
    QString errorStr;
    m_DBManager->getFilesParamsList(m_fileListDB);
    for(int i = 0; i < m_fileListDB.size(); i++)
    {
        FileParams fileParams;

        checkFile.setFileName(m_fileListDB[i].fileName);
        if(checkFile.open(QIODevice::ReadOnly))
        {
            m_checksumCalc->calculate(&checkFile, hashSum);
            std::cerr << "Hashsum: ";
            std::cerr << hashSum.toHex().data() << "\n";
            fileParams.id = m_fileListDB[i].id;
            fileParams.fileName = m_fileListDB[i].fileName;
            fileParams.hashsum = hashSum.toHex();
            m_fileListCalc.append(fileParams);
            checkFile.close();
        }
        else
        {
            fileParams.id = m_fileListDB[i].id;
            fileParams.fileName = m_fileListDB[i].fileName;
            fileParams.hashsum = "Open file error!";
            m_fileListCalc.append(fileParams);
            if(m_fileListDB[i].fileName.isEmpty())
            {
                errorStr = "Wrong file name!";
            }
            else
            {
                errorStr = "Open file error: ";
                errorStr.append(m_fileListDB.at(i).fileName.toUtf8().data());
                errorStr.append("!");
            }
            m_Logger->write(errorStr);
            errorCnt++;
        }

    }

    return true;
}

//*******************************************************************************************

bool ChecksumManager::inspect()
{
    QString errorStr;
    errorCnt = 0;
    if(prepare())
    {
       for(int i = 0; i < m_fileListDB.size(); ++i)
       {
           if(m_fileListDB.at(i).hashsum != m_fileListCalc[i].hashsum)
           {
               errorStr = "File hashsum error: ";
               errorStr.append(m_fileListDB.at(i).fileName.toUtf8().data());
               errorStr.append("!");
               m_Logger->write(errorStr);
               std::cerr << "\nFile hashsum error: " << m_fileListDB.at(i).fileName.toUtf8().data() << "!!!\n";
               errorCnt++;
           }
       }
    }

    if(errorCnt == 0)
    {
        m_Logger->write("Hashsum check finished successful!");
        std::cerr << "\nHashsum check finished successful!\n";
    }
    else
    {
        errorStr = "Hashsum check finished with ";
        errorStr.append(QString::number(errorCnt));
        errorStr.append(" error(s)!");
        m_Logger->write(errorStr);
        std::cerr << "\nHashsum check finished with " << errorCnt << " errors!!!\n";
    }
    return true;
}

//*******************************************************************************************

bool ChecksumManager::update()
{
    QString errorStr;
    bool isOk = false;
    errorCnt = 0;
    if(prepare())
    {
        isOk = m_DBManager->setFilesParamsList(m_fileListCalc);
        if(isOk && errorCnt == 0)
        {
            m_Logger->write("Checksum updating is finished successfully.");
        }
        else
        {
            if(!isOk)
                errorCnt++;
            errorStr = "Hashsum check finished with ";
            errorStr.append(QString::number(errorCnt));
            errorStr.append(" error(s)!");
            m_Logger->write(errorStr);
            std::cerr << "\nHashsum check finished with " << errorCnt << " errors!!!\n";
        }
    }

    return isOk;
}

//*******************************************************************************************

void ChecksumManager::setDBManager(DBManager *dbManager)
{
    m_DBManager = dbManager;
}

//*******************************************************************************************

void ChecksumManager::setHashAlgorithm(const QCryptographicHash::Algorithm &hashAlgorithm)
{
    m_hashAlgorithm = hashAlgorithm;
}

//*******************************************************************************************

void ChecksumManager::initialyze()
{
    m_checksumCalc = new ChecksumCalculator(m_hashAlgorithm);
}

//*******************************************************************************************

void ChecksumManager::deinitialyze()
{
    if(m_checksumCalc != NULL)
    {
        delete m_checksumCalc;
        m_checksumCalc = NULL;
    }
}


//*******************************************************************************************

void ChecksumManager::setLogger(Logger *logger)
{
    m_Logger = logger;
}

//*******************************************************************************************
