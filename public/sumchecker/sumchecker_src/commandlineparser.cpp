#include "commandlineparser.h"
#include <iostream>

#define COMMAND_LINE_PARAMS 2

CommandLineParser::CommandLineParser(QObject *parent) : QObject(parent)
{

}

//*****************************************************************************************************

bool CommandLineParser::parse(int argc, char *argv[], ApplicationConfig &appConf)
{

    QString errorStr = "\nInvalid command arguments! See sumchecker --help for details.\n";
    QString usageStr = "\nParameters for execution summcheker application:\n"
                       "update - is used for update checksums for all files in database;\n"
                       "check - is used for checking file checksum is correct;\n"
                       "--help - is used to see this help\n";

    if(argc == COMMAND_LINE_PARAMS)
    {
        if(QString(argv[1]) == QString("update"))
        {
            appConf.action = UPDATE;
        }
        else if(QString(argv[1]) == QString("check"))
        {
            appConf.action = CHECK;
        }
        else if(QString(argv[1]) == QString("--help"))
        {
            std::cerr << usageStr.toLocal8Bit().data();
            return false;
        }
        else
        {
            std::cerr << errorStr.toLocal8Bit().data();
            return false;
        }
    }
    else
    {
        std::cerr << errorStr.toLocal8Bit().data();
        return false;
    }
    return true;

}

//*****************************************************************************************************


//*****************************************************************************************************



//*****************************************************************************************************
