
/*****************************************************************************************

  Author: Alexander Shopin 04.2021

  This class is managing Database connection. It provides such functions like connect, disconnect,
  check connection, execute SQL queries which provides SQLQueryManager class.

******************************************************************************************/


#ifndef DBCONNECTION_H
#define DBCONNECTION_H

#include <QObject>
#include <QMutex>
#include <postgresql/libpq-fe.h>

class Logger;

class DBConnection : public QObject
{
    Q_OBJECT
public:
    explicit DBConnection(QObject *parent = nullptr);
    void init(const QString &connectStr);
    bool isConnectOk() const;
    QStringList execQuery(const QString &query, ExecStatusType &queryStatus);
    void deinit();
    void setLogger(Logger *logger);

signals:


private:
    PGconn *mDBConnection;
    QString m_connectStr;
    QMutex mutex;
    Logger *m_Logger;

    QStringList queryStart(const QString &query, ExecStatusType &queryStatus);
    void errorAction();

};

#endif // DBCONNECTION_H
