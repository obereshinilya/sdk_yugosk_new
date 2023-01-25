#include "queryformer.h"
#include <dbconnection.h>
#include <iostream>


QueryFormer::QueryFormer(QObject *parent) : QObject(parent)
{

}

//*******************************************************************************

bool QueryFormer::queryFilesParamsList(QStringList &fileParamsStrList)
{
    ExecStatusType queryStatus;
    QString queryStr("SELECT id, path, checksum  FROM sumchecker.check_config");
    fileParamsStrList = m_DBConnect->execQuery(queryStr, queryStatus);
    if(queryStatus == PGRES_TUPLES_OK)
        return true;

    return false;
}

//*******************************************************************************

void QueryFormer::setDatabaseConnection(DBConnection *DBConnect)
{
    m_DBConnect = DBConnect;
}

//*******************************************************************************

bool QueryFormer::setFilesParamsList(const FileParams &fileParams)
{
    ExecStatusType queryStatus;
    QString queryStr(QString("UPDATE sumchecker.check_config SET (checksum) = ('")
                     + fileParams.hashsum + QString("') WHERE id = ") + QString::number(fileParams.id));

     //std::cerr << "\nqueryStr: " << queryStr.toUtf8().data() << "\n";
     m_DBConnect->execQuery(queryStr, queryStatus);
     if(queryStatus == PGRES_COMMAND_OK)
         return true;
     return false;
}

//*******************************************************************************

bool QueryFormer::writeLog(const LogData &logData)
{
    ExecStatusType queryStatus;
    QString queryStr(QString("INSERT INTO sumchecker.check_log ( id, time, event )  VALUES (DEFAULT, '")
                    + logData.time + QString("', '") + logData.logEvent + QString("')"));

    //std::cerr << "\nqueryStr: " << queryStr.toUtf8().data() << "\n";
    m_DBConnect->execQuery(queryStr, queryStatus);
    if(queryStatus == PGRES_COMMAND_OK)
        return true;
    return false;
}

//*******************************************************************************
