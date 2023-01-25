#include "sumcheckerapp.h"
#include <configfileparser.h>
#include <dbconnection.h>
#include <checksummanager.h>
#include <queryformer.h>
#include <dbmanager.h>
#include <logger.h>
#include "datavalidator.h"

#include <iostream>

SumCheckerApp::SumCheckerApp(QObject *parent) : QObject(parent)
{
    m_confFileParser = new ConfigFileParser();
    m_DBConnect = new DBConnection();
    m_checksumManager = new ChecksumManager();
    m_queryFormer = new QueryFormer();
    m_DBManager = new DBManager();
    m_Logger = new Logger();
}

//*************************************************************************************

SumCheckerApp::~SumCheckerApp()
{
    if(m_confFileParser != NULL)
    {
        delete m_confFileParser;
    }
    if(m_DBConnect != NULL)
    {
        delete m_DBConnect;
    }
    if(m_checksumManager != NULL)
    {
        delete m_checksumManager;
    }
    if(m_queryFormer != NULL)
    {
        delete m_queryFormer;
    }
    if(m_DBManager != NULL)
    {
        delete m_DBManager;
    }
}

//*************************************************************************************

bool SumCheckerApp::initialyze(ApplicationConfig &appConf)
{
    if(!m_confFileParser->parse(appConf))
    {
        std::cerr << DataValidator::getLastError().toUtf8().data();
        return false;
    }

    m_appConf = appConf;

    m_DBConnect->init(m_appConf.DBPath);
    if(m_DBConnect->isConnectOk())
    {
        m_queryFormer->setDatabaseConnection(m_DBConnect);
        m_DBManager->setQueryFormer(m_queryFormer);
        initLogger();
        m_checksumManager->setLogger(m_Logger);
        m_checksumManager->setDBManager(m_DBManager);
        m_checksumManager->setHashAlgorithm(m_appConf.hashAlgorithm);
        m_checksumManager->initialyze();
    }
    else
    {
        std::cerr << "Error Database connection!\n";
        return false;
    }

    return true;
}

//*************************************************************************************

bool SumCheckerApp::execute()
{
    m_Logger->write("Application initialyzed.");

    if(m_appConf.action == UPDATE)
    {
        m_Logger->write("Starting update database files checksum.");
        m_checksumManager->update();
    }
    if(m_appConf.action == CHECK)
    {
        m_Logger->write("Start inspecting files checksum.");
        m_checksumManager->inspect();
    }
    return true;
}

//*************************************************************************************

bool SumCheckerApp::deinitialyze()
{
    if(m_Logger->isInited())
        m_Logger->write("Deinitialyzing application.");
    m_checksumManager->deinitialyze();
    if(m_Logger->isInited())
        m_Logger->write("Sumchecker stopped.");
    return true;
}

//*************************************************************************************

void SumCheckerApp::initLogger()
{
    m_Logger->setDBManager(m_DBManager);
    m_Logger->setLogfileName(logFilePath);
    m_Logger->initialyze(m_appConf.logType);
    m_Logger->write("Program sumcker started!");
    m_Logger->write("Initialyzing application.");

}

//*************************************************************************************
