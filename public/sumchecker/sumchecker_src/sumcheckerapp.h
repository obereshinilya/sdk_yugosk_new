
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This dispatcher class that is used for creation, initialization,
    run execution processes.

******************************************************************************/

#ifndef SUMCHECKERAPP_H
#define SUMCHECKERAPP_H

#include <QObject>
#include <sumcheckertypes.h>

class ConfigFileParser;
class DBConnection;
class ChecksumManager;
class QueryFormer;
class DBManager;
class Logger;

class SumCheckerApp : public QObject
{
    Q_OBJECT
public:
    explicit SumCheckerApp(QObject *parent = nullptr);
    ~SumCheckerApp();

    bool initialyze(ApplicationConfig &appConf);
    bool execute();
    bool deinitialyze();

private:

    void initLogger();

    ConfigFileParser *m_confFileParser;
    DBConnection *m_DBConnect;
    ChecksumManager *m_checksumManager;
    QueryFormer *m_queryFormer;
    DBManager *m_DBManager;
    Logger *m_Logger;


    ApplicationConfig m_appConf;

signals:

};

#endif // SUMCHECKERAPP_H
