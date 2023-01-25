
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is used for calculating files checksums with Qt5 library
    class QCryptographicHash.

    Supported hash algorithms:

    QCryptographicHash::Md4         0               Generate an MD4 hash sum
    QCryptographicHash::Md5         1               Generate an MD5 hash sum
    QCryptographicHash::Sha1        2               Generate an SHA-1 hash sum
    QCryptographicHash::Sha224      3               Generate an SHA-224 hash sum (SHA-2). Introduced in Qt 5.0
    QCryptographicHash::Sha256      4               Generate an SHA-256 hash sum (SHA-2). Introduced in Qt 5.0
    QCryptographicHash::Sha384      5               Generate an SHA-384 hash sum (SHA-2). Introduced in Qt 5.0
    QCryptographicHash::Sha512      6               Generate an SHA-512 hash sum (SHA-2). Introduced in Qt 5.0
    QCryptographicHash::Sha3_224	RealSha3_224	Generate an SHA3-224 hash sum. Introduced in Qt 5.1
    QCryptographicHash::Sha3_256	RealSha3_256	Generate an SHA3-256 hash sum. Introduced in Qt 5.1
    QCryptographicHash::Sha3_384	RealSha3_384	Generate an SHA3-384 hash sum. Introduced in Qt 5.1
    QCryptographicHash::Sha3_512	RealSha3_512	Generate an SHA3-512 hash sum. Introduced in Qt 5.1


 ****************************************************************************/

#ifndef CHECKSUMCALCULATOR_H
#define CHECKSUMCALCULATOR_H


#include <QCryptographicHash>

class ChecksumCalculator : public QCryptographicHash
{

public:
    explicit ChecksumCalculator(QCryptographicHash::Algorithm method);
    virtual ~ChecksumCalculator();

    bool calculate(QIODevice *device, QByteArray &hash);


private:




};

#endif // CHECKSUMCALCULATOR_H
