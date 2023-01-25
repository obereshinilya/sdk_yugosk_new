#include "logwriterdb.h"
#include <iostream>
#include <dbmanager.h>

LogWriterDB::LogWriterDB(DBManager *DBMan)
    : m_DBManager(DBMan)
{

}

//**********************************************************************************

LogWriterDB::~LogWriterDB()
{

}

//**********************************************************************************

void LogWriterDB::write(const LogData &logData)
{
    m_DBManager->writeLog(logData);
}

//**********************************************************************************

void LogWriterDB::setDBManager(DBManager *DBMan)
{
    m_DBManager = DBMan;
}

//**********************************************************************************
