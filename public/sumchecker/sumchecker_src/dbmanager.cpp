#include "dbmanager.h"
#include <queryformer.h>

DBManager::DBManager()
{

}

//*********************************************************************************

bool DBManager::getFilesParamsList(QList<FileParams> &fileParamsList)
{
    QStringList paramsStrList;
    m_queryFormer->queryFilesParamsList(paramsStrList);
    return parseFileParamsList(paramsStrList, fileParamsList);
}

//*********************************************************************************

void DBManager::setQueryFormer(QueryFormer *queryFormer)
{
    m_queryFormer = queryFormer;
}

//*********************************************************************************

bool DBManager::parseFileParamsList(const QStringList &paramsStrList, QList<FileParams> &fileParamsList)
{
    for (int i = 0; i < paramsStrList.size(); ++i)
    {
        FileParams fileParams;
        QStringList entry = paramsStrList.at(i).split("^^^", QString::KeepEmptyParts);
        fileParams.id = entry.at(1).toInt();
        fileParams.fileName = entry.at(2);
        fileParams.hashsum = entry.at(3);
        fileParamsList.append(fileParams);
    }
    return true;
}

//*********************************************************************************

bool DBManager::setFilesParamsList(const QList<FileParams> &fileParamsList)
{
    int errorCnt = 0;
    for(int i = 0; i < fileParamsList.size(); ++i)
    {
        if(!m_queryFormer->setFilesParamsList(fileParamsList.at(i)))
            errorCnt++;
    }
    if(errorCnt == 0)
        return true;
    return false;
}

//*********************************************************************************

bool DBManager::writeLog(const LogData &logData)
{
    return m_queryFormer->writeLog(logData);
}

//*********************************************************************************
