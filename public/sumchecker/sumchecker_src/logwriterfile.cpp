#include "logwriterfile.h"
#include <iostream>
#include <QFile>


LogWriterFile::LogWriterFile(const QString &fileName)
    : m_fileName(fileName)
{

}

LogWriterFile::~LogWriterFile()
{

}

void LogWriterFile::write(const LogData &logData)
{
    QFile logFile(m_fileName);
    if(logFile.open(QIODevice::Append))
    {
        QString logSting = logData.time + "   ";
        logSting.append(logData.logEvent + "\n");
        logFile.write(logSting.toUtf8().data());
        logFile.close();
    }
    else
    {
        std::cerr << "Error! Could not open logfile for writing! Check access rights.\n";
    }
}
