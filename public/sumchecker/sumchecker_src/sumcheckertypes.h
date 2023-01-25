
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This file conains all common aplication types, enums and constants.

******************************************************************************/

#ifndef SUMCHECKERTYPES_H
#define SUMCHECKERTYPES_H

#include <QString>
#include <QCryptographicHash>


const QString configFilePath = "./sumcheckerconfig.xml";
const QString logFilePath = "./sumchecker.log";

enum Action {UPDATE, CHECK};                            // program action update/check
enum LogType {HD_FILE, DATABASE, FILE_AND_DATABASE};    // logger type

struct ApplicationConfig { // configuration struct, values set from sumcheckerconfig.xml and command line params

    Action action;
    QString DBPath;
    QCryptographicHash::Algorithm hashAlgorithm;
    LogType logType;

};

struct FileParams {
    int id;
    QString fileName;
    QString hashsum;
};

struct LogData {        // data for logging
    QString time;
    QString logEvent;
};



#endif // SUMCHECKERTYPES_H
