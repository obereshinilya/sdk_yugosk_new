#include "checksumcalculator.h"
#include <QCryptographicHash>

ChecksumCalculator::ChecksumCalculator(QCryptographicHash::Algorithm method)
    : QCryptographicHash(method)
{

}

//*******************************************************************************************

ChecksumCalculator::~ChecksumCalculator()
{

}

//*******************************************************************************************

bool ChecksumCalculator::calculate(QIODevice *device, QByteArray &hash)
{
    if(!addData(device))
        return false;

    hash = result();
    reset();
    return true;
}

//*******************************************************************************************
