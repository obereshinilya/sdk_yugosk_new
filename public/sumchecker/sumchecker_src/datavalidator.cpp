#include "datavalidator.h"

QString DataValidator::m_validationErrorStr = "";

QStringList DataValidator::algorithmList = {"Md4", "Md5", "Sha1", "Sha224", "Sha256",
                                            "Sha384", "Sha512", "Sha3_224", "Sha3_256",
                                            "Sha3_384", "Sha3_512"};

DataValidator::DataValidator(QObject *parent) : QObject(parent)
{

}

bool DataValidator::validateAlgorithmType(const QString &algorithmStr)
{
     if(!algorithmList.contains(algorithmStr))
     {
         DataValidator::m_validationErrorStr = "Error! Parameter <algorithm> is invalid!\n";
         return false;
     }
     return true;
}

//****************************************************************************

bool DataValidator::validateLogType(const QString &logTypeStr)
{
    if(logTypeStr.toLower() == QString("database")  ||
       logTypeStr.toLower() == QString("file")  ||
       logTypeStr.toLower() == QString("file_and_database"))

    {
        return true;
    }
    DataValidator::m_validationErrorStr = "Error! Parameter <logtype> is invalid!\n";
    return false;
}


//****************************************************************************

QString DataValidator::getLastError()
{
    return DataValidator::m_validationErrorStr;
}

//****************************************************************************
