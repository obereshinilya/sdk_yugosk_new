
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is extends LogWriter interface for writing logs to database.

******************************************************************************/

#ifndef LOGWRITERFILEDB_H
#define LOGWRITERFILEDB_H

#include <logwriter.h>

class DBManager;
class LogWriterFile;
class LogWriterDB;

class LogWriterFileDB : public LogWriter
{
public:
    LogWriterFileDB(const QString &fileName, DBManager *DBMan);
    virtual ~LogWriterFileDB();
    virtual void write(const LogData &logData);

private:
    QString m_fileName;
    DBManager *m_DBManager;

    LogWriterFile *logWriterFile;
    LogWriterDB *logWriterDB;

};

#endif // LOGWRITERFILEDB_H
