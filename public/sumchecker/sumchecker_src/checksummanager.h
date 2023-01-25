
/*****************************************************************************

    Author: Alexander Shopin 04.2021

    This class is managing process of calculating and updating checksums.


******************************************************************************/

#ifndef CHECKSUMMANAGER_H
#define CHECKSUMMANAGER_H

#include <QObject>
#include <QList>
#include <sumcheckertypes.h>


class DBManager;
class ChecksumCalculator;
class Logger;


class ChecksumManager : public QObject
{
    Q_OBJECT
public:
    explicit ChecksumManager(QObject *parent = nullptr);
    ~ChecksumManager();
    bool update();                      // updating checksums in database
    bool inspect();                     // inspecting checksums for files in database list
    void setDBManager(DBManager *dbManager);
    void setHashAlgorithm(const QCryptographicHash::Algorithm &hashAlgorithm);
    void initialyze();
    void deinitialyze();
    void setLogger(Logger *logger);

private:

    bool prepare();
    bool getFileList();

    QList<FileParams> m_fileListDB;
    QList<FileParams> m_fileListCalc;
    DBManager *m_DBManager;
    ChecksumCalculator *m_checksumCalc;
    QCryptographicHash::Algorithm m_hashAlgorithm;
    Logger *m_Logger;
    int errorCnt;


signals:

};

#endif // CHECKSUMUPDATER_H
