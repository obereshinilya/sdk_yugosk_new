QT -= gui
QT += xml

CONFIG += c++11 console
CONFIG -= app_bundle

# The following define makes your compiler emit warnings if you use
# any Qt feature that has been marked deprecated (the exact warnings
# depend on your compiler). Please consult the documentation of the
# deprecated API in order to know how to port your code away from it.
DEFINES += QT_DEPRECATED_WARNINGS

# You can also make your code fail to compile if it uses deprecated APIs.
# In order to do so, uncomment the following line.
# You can also select to disable deprecated APIs only up to a certain version of Qt.
#DEFINES += QT_DISABLE_DEPRECATED_BEFORE=0x060000    # disables all the APIs deprecated before Qt 6.0.0

SOURCES += \
        checksumcalculator.cpp \
        checksummanager.cpp \
        commandlineparser.cpp \
        configfileparser.cpp \
        datavalidator.cpp \
        dbconnection.cpp \
        dbmanager.cpp \
        logger.cpp \
        logwriter.cpp \
        logwriterdb.cpp \
        logwriterfile.cpp \
        logwriterfiledb.cpp \
        main.cpp \
        queryformer.cpp \
        sumcheckerapp.cpp

# Default rules for deployment.
qnx: target.path = /tmp/$${TARGET}/bin
else: unix:!android: target.path = /opt/$${TARGET}/bin
!isEmpty(target.path): INSTALLS += target

HEADERS += \
    checksumcalculator.h \
    checksummanager.h \
    commandlineparser.h \
    configfileparser.h \
    datavalidator.h \
    dbconnection.h \
    dbmanager.h \
    logger.h \
    logwriter.h \
    logwriterdb.h \
    logwriterfile.h \
    logwriterfiledb.h \
    queryformer.h \
    sumcheckerapp.h \
    sumcheckertypes.h


LIBS += -lpq

INCLUDEPATH += $$PWD/../../../../usr/include/postgresql
DEPENDPATH += $$PWD/../../../../usr/include/postgresql






