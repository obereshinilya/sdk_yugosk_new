
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is used for managing all SQL requests.
    It is receiving from DBManager commands, forming SQL requests and send
    requests for low level DB class - DBConnection for execution.

******************************************************************************/

#ifndef QUERYFORMER_H
#define QUERYFORMER_H

#include <QObject>
#include <sumcheckertypes.h>
#include <postgresql/libpq-fe.h>

class DBConnection;

class QueryFormer : public QObject
{
    Q_OBJECT
public:
    explicit QueryFormer(QObject *parent = nullptr);

    void setDatabaseConnection(DBConnection *DBConnect);
    bool queryFilesParamsList(QStringList &fileParamsStrList);
    bool setFilesParamsList(const FileParams &fileParams);
    bool writeLog(const LogData &logData);

private:
    DBConnection *m_DBConnect;

signals:

};

#endif // QUERYFORMER_H
