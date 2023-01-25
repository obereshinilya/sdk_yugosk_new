#include "dbconnection.h"
#include <iostream>
#include <logger.h>

DBConnection::DBConnection(QObject *parent) : QObject(parent)
{

}

//****************************************************************************

void DBConnection::init(const QString &connectStr)
{
    m_connectStr = connectStr;
    //std::cerr << "connectStr: " << connectStr.toUtf8().data() << "\n";
    mDBConnection = PQconnectdb(m_connectStr.toUtf8().data());
}

//****************************************************************************

bool DBConnection::isConnectOk() const
{
    bool connOk = false;
    if(PQstatus(mDBConnection) == CONNECTION_OK)
        connOk = true;

    //std::cerr << "Status(mDBConnection) " << PQstatus(mDBConnection) << "\n";

    return connOk;
}

//****************************************************************************

QStringList DBConnection::execQuery(const QString &query, ExecStatusType &queryStatus)
{
    mutex.lock();

    QStringList outDataList;

    if(isConnectOk())
    {
        outDataList = queryStart(query, queryStatus);
    }
    else
    {
        PQreset(mDBConnection);
        if(isConnectOk())
        {
            outDataList = queryStart(query, queryStatus);
        }
        else
        {
            queryStatus = PGRES_FATAL_ERROR;
            errorAction();
        }
    }

    mutex.unlock();
    return outDataList;
}

//****************************************************************************

QStringList DBConnection::queryStart(const QString &query, ExecStatusType &queryStatus)
{
    PGresult *dbData = NULL;
    //std::cerr << query.toUtf8().data() << "\n";
    dbData = PQexec(mDBConnection, query.toUtf8().data());
    queryStatus = PQresultStatus(dbData);
    //std::cerr << "Query status: " << queryStatus << "\n";

    QStringList queryResultList;
    QString resultString = "";

    for(int tuples = 0; tuples < PQntuples(dbData); ++tuples)
    {
        resultString.truncate(0);
        resultString.append(QString("^^^"));
        for(int column = 0; column < PQnfields(dbData); ++column)
        {
            resultString.append(QString(PQgetvalue(dbData, tuples, column)));
            resultString.append(QString("^^^"));
        }
        queryResultList.append(resultString);
    }
    PQclear(dbData);
    return queryResultList;
}

//****************************************************************************

void DBConnection::deinit()
{
    PQfinish(mDBConnection);
}

//****************************************************************************

void DBConnection::errorAction()
{

}

//****************************************************************************

void DBConnection::setLogger(Logger *logger)
{
    m_Logger = logger;
}

//****************************************************************************
