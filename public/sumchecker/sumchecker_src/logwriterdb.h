
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is abstract. It is declarates common interface for all log
    writers.

******************************************************************************/


#ifndef LOGWRITERDB_H
#define LOGWRITERDB_H

#include <logwriter.h>

class  DBManager;

class LogWriterDB : public LogWriter
{
public:
    LogWriterDB(DBManager *DBMan);
    virtual ~LogWriterDB();
    void setDBManager(DBManager *DBMan);
    virtual void write(const LogData &logData);

private:
    DBManager *m_DBManager;


};

#endif // LOGWRITERDB_H
