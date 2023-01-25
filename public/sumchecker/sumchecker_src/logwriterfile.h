
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is extends LogWriter interface for writing logs to logfile.

******************************************************************************/


#ifndef LOGWRITERFILE_H
#define LOGWRITERFILE_H

#include <logwriter.h>

class LogWriterFile : public LogWriter
{
public:
    LogWriterFile(const QString &fileName);
    virtual ~LogWriterFile();

    virtual void write(const LogData &logData);

private:
    QString m_fileName;



};

#endif // LOGWRITERFILE_H
