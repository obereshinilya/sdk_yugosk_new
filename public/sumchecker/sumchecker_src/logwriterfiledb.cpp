#include "logwriterfiledb.h"
#include <iostream>
#include <logwriterdb.h>
#include <logwriterfile.h>

LogWriterFileDB::LogWriterFileDB(const QString &fileName, DBManager *DBMan)
    : m_fileName(fileName), m_DBManager(DBMan)

{
    logWriterFile = new LogWriterFile(m_fileName);
    logWriterDB = new LogWriterDB(m_DBManager);
}

LogWriterFileDB::~LogWriterFileDB()
{
    if(logWriterFile != NULL)
    {
        delete logWriterFile;
    }
    if(logWriterDB != NULL)
    {
        delete logWriterDB;
    }
}

void LogWriterFileDB::write(const LogData &logData)
{
    logWriterFile->write(logData);
    logWriterDB->write(logData);
}
