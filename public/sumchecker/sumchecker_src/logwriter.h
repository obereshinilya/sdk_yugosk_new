
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is abstract. It is declarates common interface for all log
    writers.

******************************************************************************/

#ifndef LOGWRITER_H
#define LOGWRITER_H


#include <sumcheckertypes.h>

class LogWriter
{

public:
    explicit LogWriter();
    virtual ~LogWriter();

    virtual void write(const LogData &logData) = 0;

};

#endif // LOGWRITER_H
