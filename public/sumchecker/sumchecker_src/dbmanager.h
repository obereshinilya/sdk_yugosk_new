
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is managing requests for getting and setting data to
    database in format that is needed by clients.

    All SQL and low level database operations it is delegates to agregated
    objects (QueryFormer).

******************************************************************************/


#ifndef DBMANAGER_H
#define DBMANAGER_H

#include <QList>
#include <sumcheckertypes.h>

class QueryFormer;

class DBManager
{
public:
    DBManager();

    bool isConnectionOk() const;
    bool getFilesParamsList(QList<FileParams> &fileParamsList);
    bool setFilesParamsList(const QList<FileParams> &fileParamsList);
    void setQueryFormer(QueryFormer *queryFormer);
    bool writeLog(const LogData &logData);


private:

    bool parseFileParamsList(const QStringList &paramsStrList, QList<FileParams> &fileParamsList);


    QueryFormer *m_queryFormer;



};

#endif // DBMANAGER_H
