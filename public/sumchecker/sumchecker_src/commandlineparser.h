
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is parsing command line parameters.
    Valid parameters:

    sumchecker update   updating database files hashsum
    sumchecker check    check database files hashsum
    sumchecker --help   show help note

******************************************************************************/


#ifndef COMMANDLINEPARSER_H
#define COMMANDLINEPARSER_H

#include <QObject>
#include <sumcheckertypes.h>

class CommandLineParser : public QObject
{
    Q_OBJECT
public:
    explicit CommandLineParser(QObject *parent = nullptr);

    bool parse(int argc, char *argv[], ApplicationConfig &appConf);

signals:

};

#endif // COMMANDLINEPARSER_H
