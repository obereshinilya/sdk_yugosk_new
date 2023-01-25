
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is implements logging functions.
    Class functionality allows to write logs to file, database or both.
    Writing target is selected by configuration file.

******************************************************************************/

#ifndef LOGGER_H
#define LOGGER_H

#include <QObject>
#include <sumcheckertypes.h>

class LogWriter;
class DBManager;

class Logger : public QObject
{
    Q_OBJECT
public:
    explicit Logger(QObject *parent = nullptr);

    void setLogfileName(const QString &logfileName);
    void setDBManager(DBManager *DBMan);
    bool initialyze(const LogType &logType);
    void deinitialyze();
    bool isInited() const;

    void write(const QString &logStr);

private:
    LogWriter *m_logWriter;
    DBManager *m_DBManager;
    QString m_logfileName;
    bool m_isInited;



signals:



};

#endif // LOGGER_H
