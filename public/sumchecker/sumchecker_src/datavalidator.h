
/*****************************************************************************************

  Author: Alexander Shopin 02.2021

  This class is used for validating input parameters witch is recevied from soures
  where parametr values could be incorrect.

******************************************************************************************/


#ifndef DATAVALIDATOR_H
#define DATAVALIDATOR_H

#include <QObject>


class DataValidator : public QObject
{
    Q_OBJECT
public:
    explicit DataValidator(QObject *parent = nullptr);

    static bool validateAlgorithmType(const QString &algorithmStr);
    static bool validateLogType(const QString &logTypeStr);
    static QString getLastError();

signals:

private:
    static QString m_validationErrorStr;
    static QStringList algorithmList;

};

#endif // DATAVALIDATOR_H
