#include "logger.h"
#include <logwriterdb.h>
#include <logwriterfile.h>
#include <logwriterfiledb.h>
#include <dbmanager.h>
#include <iostream>
#include <qdatetime.h>

Logger::Logger(QObject *parent) : QObject(parent)
{
    m_logWriter = NULL;
    m_isInited = false;
}

//********************************************************************************

void Logger::setLogfileName(const QString &logfileName)
{
    m_logfileName = logfileName;
}

//********************************************************************************

void Logger::setDBManager(DBManager *DBMan)
{
    m_DBManager = DBMan;
}

//********************************************************************************

bool Logger::initialyze(const LogType &logType)
{
    bool isInitOk = true;
    switch (logType)
    {
        case HD_FILE: m_logWriter = new LogWriterFile(m_logfileName);
                        break;
        case DATABASE: m_logWriter = new LogWriterDB(m_DBManager);
                        break;
        case FILE_AND_DATABASE: m_logWriter = new LogWriterFileDB(m_logfileName, m_DBManager);
                        break;
        default: std::cerr << "Error! Wrong logger type value. Check config file.\n";
                 isInitOk = false;
                        break;
    }
    m_isInited = isInitOk;
    return isInitOk;
}

//********************************************************************************

void Logger::deinitialyze()
{
    if(m_logWriter != NULL)
    {
        delete m_logWriter;
        m_logWriter = NULL;
    }
}

//********************************************************************************

void Logger::write(const QString &logStr)
{
    LogData logData;
    logData.time = QDateTime::currentDateTime().toString("yyyy.MM.dd-hh:mm:ss");
    logData.logEvent = logStr;
    m_logWriter->write(logData);
}

//********************************************************************************

bool Logger::isInited() const
{
    return m_isInited;
}

//********************************************************************************
