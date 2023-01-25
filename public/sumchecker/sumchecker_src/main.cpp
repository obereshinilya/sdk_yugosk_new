#include <QCoreApplication>
#include <configfileparser.h>
#include <commandlineparser.h>
#include <sumcheckerapp.h>


int main(int argc, char *argv[])
{
    QCoreApplication a(argc, argv);

    ApplicationConfig appConf;

    CommandLineParser cmdLineParser;
    if(!cmdLineParser.parse(argc, argv, appConf))
        return -1;

    SumCheckerApp sumCheckerApp;
    if(sumCheckerApp.initialyze(appConf))
        sumCheckerApp.execute();

    sumCheckerApp.deinitialyze();

    return 0;
}
