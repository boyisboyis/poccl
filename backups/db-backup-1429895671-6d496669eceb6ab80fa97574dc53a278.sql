DROP TABLE guarantee;

CREATE TABLE `guarantee` (
  `GID` int(15) NOT NULL AUTO_INCREMENT,
  `JID` varchar(20) NOT NULL,
  `Terms` int(2) NOT NULL,
  `Guarantee_Type` varchar(20) NOT NULL,
  `Amount_Actual_Price` float unsigned DEFAULT NULL,
  `Amount_Actual_Percentage` float(5,2) unsigned DEFAULT NULL,
  `Start_Plan` date NOT NULL,
  `Start_Actual` date DEFAULT NULL,
  `Until_Plan` date NOT NULL,
  `Until_Actual` date DEFAULT NULL,
  `Return_Bank_Date` date DEFAULT NULL,
  PRIMARY KEY (`GID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO guarantee VALUES("1","58-0203","1","Mechanical Guarantee","1510350","10.00","2015-10-31","","2018-10-31","","");
INSERT INTO guarantee VALUES("2","58-0203","1","Performance Guarante","1510350","10.00","2015-01-28","","2016-01-28","","");
INSERT INTO guarantee VALUES("3","15-8297","1","Advance Payment Bond","2700000","10.00","2015-03-10","","2016-11-30","","");
INSERT INTO guarantee VALUES("4","15-8289 REV.1","1","Warranty Bond","335000","10.00","2015-08-03","","2017-02-03","","");
INSERT INTO guarantee VALUES("5","15-8302","1","Warranty Bond","","","2015-04-07","","2017-04-07","","");
INSERT INTO guarantee VALUES("6","58-0202","1","Warranty Bond","","","2015-10-21","","2017-04-21","","");



DROP TABLE guarantee_type;

CREATE TABLE `guarantee_type` (
  `GTID` int(4) NOT NULL AUTO_INCREMENT,
  `Description` varchar(30) NOT NULL,
  PRIMARY KEY (`GTID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO guarantee_type VALUES("1","Advance Payment Bond");
INSERT INTO guarantee_type VALUES("2","Performance Bond");
INSERT INTO guarantee_type VALUES("3","Warranty Bond");
INSERT INTO guarantee_type VALUES("4","Refund Bond");



DROP TABLE job;

CREATE TABLE `job` (
  `JID` varchar(20) NOT NULL,
  `Project_Name` varchar(100) DEFAULT NULL,
  `Project_Location` varchar(50) DEFAULT NULL,
  `Project_Owner` varchar(100) DEFAULT NULL,
  `Secrecy_Agreement` tinyint(1) DEFAULT NULL,
  `Work_Start_Date` date NOT NULL,
  `Work_Complete_Date` date DEFAULT NULL,
  `PO_Date` date DEFAULT NULL,
  `PO_Type` varchar(20) DEFAULT NULL,
  `Contract_Value_THB` float(20,2) NOT NULL,
  `Contract_Value_Other` float(20,2) DEFAULT NULL,
  `Contract_Value_Type` varchar(4) DEFAULT NULL,
  `Contract_Value_Rate` float(4,2) DEFAULT NULL,
  `Goveming_Law` varchar(15) DEFAULT NULL,
  `Credit_Term` int(2) DEFAULT NULL,
  `Late_Pay_Finan_Charge` tinyint(1) DEFAULT NULL,
  `Check_List` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`JID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO job VALUES("10-9999","","","","","2015-04-08","","","","4650000.00","4650000.00","JPY","1.00","","","","0");
INSERT INTO job VALUES("15-8284","","","","","2015-01-08","2015-01-30","","","690000.00","","","","","","","0");
INSERT INTO job VALUES("15-8285","","","","","2015-01-09","","","","5000000.00","","","","","","","0");
INSERT INTO job VALUES("15-8286","","","","","2015-01-13","2015-01-30","","","1920000.00","","","","","","","0");
INSERT INTO job VALUES("15-8287","","","","","2015-01-15","2015-02-15","","","300000.00","","","","","","","0");
INSERT INTO job VALUES("15-8288","","Thailand","EURO-Waste Engineering Co., Ltd.","0","2015-01-16","2015-06-30","2015-01-09","Fix Lump Sum","4590000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8289 REV.1","Polycarbonate Unit Expansion Project","Map Ta Phut, Rayong province, Thailand","Bayer Thai Co., Ltd","0","2015-01-21","2015-08-03","2015-01-21","Fix Lump Sum","3350000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8290","","","","","2015-01-20","2015-03-20","","","2100000.00","","","","","","","0");
INSERT INTO job VALUES("15-8291","","Thailand","Thai Mannings Furnace Co., Ltd.","0","2015-01-22","2015-01-27","2015-01-21","Fix Lump Sum","8000.00","","","","Thailand","60","0","1");
INSERT INTO job VALUES("15-8292","","","","","2015-01-23","2015-02-20","","","5260000.00","","","","","","","0");
INSERT INTO job VALUES("15-8293","","","","","2015-01-23","2015-04-20","","","1533120.00","47910.00","USD","32.00","","","","0");
INSERT INTO job VALUES("15-8294","","","","","2015-01-23","2015-04-20","","","1913600.00","59800.00","USD","32.00","","","","0");
INSERT INTO job VALUES("15-8295","Rung Tawan Project II","Thailand","JSR BST Elastomer Co., Ltd.","0","2015-01-23","2015-02-20","2015-01-26","Fix Lump Sum","595000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8295 Add#1","Rung Tawan Project II","Thailand","JSR BST Elastomer Co., Ltd.","0","2015-01-23","2015-02-20","2015-02-03","Fix Lump Sum","15000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8296","","","","","2015-01-28","2015-04-05","","","2121000.00","","","","","","","0");
INSERT INTO job VALUES("15-8297","","Rayong, Thailand","TPI Polene Public Company Limited","0","2015-01-29","2015-12-30","2015-02-09","Fix Lump Sum","28890000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8298","","Thailand","Thai Mannings Furnace Co., Ltd.","0","2015-01-31","2015-02-05","2015-02-04","Fix Lump Sum","8000.00","","","","Thailand","60","0","1");
INSERT INTO job VALUES("15-8299","","Thailand","Siam Steel Structure Co., Ltd.","0","2015-02-03","2015-02-20","2015-02-03","Fix Lump Sum","25150.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8300","","Thailand","Perz Co., Ltd.","0","2015-02-03","2015-02-20","2015-02-06","Fix Lump Sum","190000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8301","","","","","2015-02-10","2015-03-25","","","700000.00","","","","","","","0");
INSERT INTO job VALUES("15-8302","Reactor 3 Modification ","Thailand","Bayer Thai Company Limited","0","2015-02-11","2015-04-07","2015-02-09","Fix Lump Sum","3100000.00","","","","Thailand","60","0","1");
INSERT INTO job VALUES("15-8303","","","","","2015-02-11","2015-02-28","","","1200000.00","","","","","","","0");
INSERT INTO job VALUES("15-8304","Rung Tawan Project II (Reinforcement of Existing Structure in Area 10100 and 10200)","Thailand","JSR BST ELASTOMER Co., LTD.","0","2015-02-13","2015-03-31","2015-03-03","Fix Lump Sum","8400000.00","","","","Thailand","60","0","1");
INSERT INTO job VALUES("15-8305","","","","","2015-02-17","2015-04-30","","","565000.00","","","","","","","0");
INSERT INTO job VALUES("15-8306","","","","","2015-02-17","2015-03-10","","","300000.00","","","","","","","0");
INSERT INTO job VALUES("15-8307","Vessel \"R\" stamp","Thailand","Bayer Thai Company Limited","1","2015-02-17","2015-03-04","2015-02-17","Fix Lump Sum","120000.00","","","","Thailand","60","0","1");
INSERT INTO job VALUES("15-8308","","","","","2015-02-17","2015-03-25","","","680000.00","","","","","","","0");
INSERT INTO job VALUES("15-8309","","","","","2015-02-17","2015-03-26","","","720000.00","","","","","","","0");
INSERT INTO job VALUES("15-8310","2301 PTTEPI L53/43 & 54/43","","","","2015-02-20","2015-04-20","2015-02-19","","1222640.00","","","","","30","","0");
INSERT INTO job VALUES("15-8311","","Thailand","Thai Hirakawa Co.,ltd","0","2015-02-21","2015-04-20","2015-02-21","Fix Lump Sum","350000.00","","","","Thailand","0","0","1");
INSERT INTO job VALUES("15-8312","","","","","2015-02-24","2015-03-24","","","1392000.00","","","","","","","0");
INSERT INTO job VALUES("15-8313","","","","","2015-03-04","2015-05-10","","","920000.00","","","","","","","0");
INSERT INTO job VALUES("15-8314","U-Thai Power Plant Project","Thailand","Gulf JP UP Company Limited","0","2015-03-06","2015-04-20","2015-03-06","Fix Lump Sum","50000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8315","","","","","2015-03-10","2015-04-28","","","1160000.00","","","","","","","0");
INSERT INTO job VALUES("15-8316","","","","","2015-03-11","2015-05-20","","","1200000.00","","","","","","","0");
INSERT INTO job VALUES("15-8317","","","","","2015-03-11","2015-05-25","","","660000.00","","","","","","","0");
INSERT INTO job VALUES("15-8318","","Thailand","Siam Steel Structure Co., Ltd.","0","2015-03-12","2015-03-31","2015-03-13","Fix Lump Sum","350000.00","","","","Thailand","30","0","1");
INSERT INTO job VALUES("15-8319","","Myanmar","Myanmar Megastee Industries Ltd.","0","2015-03-13","2015-03-22","2015-03-13","Fix Lump Sum","414472.50","12675.00","USD","32.70","Thailand","0","0","1");
INSERT INTO job VALUES("15-8320","","","","","2015-03-17","2015-06-30","","","2900000.00","","","","","","","0");
INSERT INTO job VALUES("15-8321","","Thailand","Thai Mannings Furnace Co., Ltd.","0","2015-03-18","2015-03-19","2015-03-18","Fix Lump Sum","8000.00","","","","Thailand","60","0","1");
INSERT INTO job VALUES("15-8322","","","","","2015-03-18","2015-03-27","","","610000.00","","","","","","","0");
INSERT INTO job VALUES("15-8323","","","","","2015-03-19","2015-05-15","","","200000.00","","","","","","","0");
INSERT INTO job VALUES("15-8324","Welded Repair for E-1310","","","","2015-03-24","2015-03-30","","","1448128.00","45254.00","USD","32.00","","","","0");
INSERT INTO job VALUES("15-8325","","","","","2015-03-25","2015-05-25","","","3880000.00","","","","","","","0");
INSERT INTO job VALUES("15-8326","Spare Tube Bundle of E3001 A/B","","","","2015-03-26","2015-09-30","","","4650000.00","","","","","","","0");
INSERT INTO job VALUES("15-8327","","","","","2015-03-27","2015-05-20","","","1950000.00","","","","","","","0");
INSERT INTO job VALUES("58-0200","Tank Refurbishment (Major-Defect-Inner Leak)","","","","2015-01-13","2015-04-07","","","265000.00","","","","","","","0");
INSERT INTO job VALUES("58-0201 Rev#1","Amata Bowin V17488 Project","","","","2015-01-29","2015-11-01","2014-12-24","","6929780.50","210312.00","USD","32.95","","","","0");
INSERT INTO job VALUES("58-0202","Amata Bowin ZV17488) Project","Bowin Sriracha, Chonburi provice, Thailand","Bowin Clean Energy Limited","0","2015-01-26","2015-10-21","2015-01-26","Fix Lump Sum","2732009.50","86456.00","USD","31.60","English law","30","0","1");
INSERT INTO job VALUES("58-0203","Chevron CVX Phase 50 Project","CUEL Laem Chabang Yard, Thailand","Chevron Thailand Exploration and Production, Ltd.","0","2015-01-28","2015-10-31","2015-01-26","Fix Lump Sum","15103457.00","","","","Thailand","60","","1");
INSERT INTO job VALUES("58-0204","Chevron CVX Phase 50 Project","CUEL Laem Chabang Yard, Thailand","Chevron Thailand Exploration and Production, Ltd.","0","2015-03-02","2015-10-06","2015-02-25","Fix Lump Sum","4892062.50","","","","Thailand","60","","1");
INSERT INTO job VALUES("58-0205","CVX Phase 50 Project","","","","2015-03-02","","","","2364375.00","","","","","","","0");
INSERT INTO job VALUES("58-0206","CVX Phase 50 Project","","","","2015-03-02","","","","5106563.00","","","","","","","0");
INSERT INTO job VALUES("58-0207","CVX50 Phase 50","","","","2015-03-02","","","","1755000.00","","","","","","","0");
INSERT INTO job VALUES("58-0208","","Thailand","ศิรวัฒน์ผลิตภัณฑ์แก๊ส","0","2015-01-29","2015-03-31","2015-01-29","Fix Lump Sum","934579.44","","","","Thailand","30","0","1");
INSERT INTO job VALUES("58-0209","ABPR IV (V17490) Project","-","","","2015-01-29","2017-05-01","","","6929780.50","210312.00","USD","32.95","","","","0");
INSERT INTO job VALUES("58-0210","ABPR V (V17491) Project","","","","2015-01-29","2017-09-01","","","6929780.50","210312.00","USD","32.95","","","","0");
INSERT INTO job VALUES("58-0211","50mv  AT  Thilawa  SEZ  Project","","","","2015-02-05","2015-08-05","","","12662560.00","395705.00","USD","32.00","","","","0");
INSERT INTO job VALUES("58-0212","AAA Project","","","","2015-03-04","2015-10-26","","","6397886.00","195654.00","USD","32.70","","","","0");
INSERT INTO job VALUES("58-0213","Golar Hili FING Project","","","","2015-03-09","2015-09-07","","","4678089.00","125620.00","EUR","37.24","","","","0");



DROP TABLE payment;

CREATE TABLE `payment` (
  `PID` int(15) NOT NULL AUTO_INCREMENT,
  `JID` varchar(20) NOT NULL,
  `Terms` int(2) NOT NULL,
  `Payment_Type` varchar(20) NOT NULL,
  `Amount_Actual_Price` float(15,2) unsigned DEFAULT NULL,
  `Amount_Actual_Percentage` float(5,2) unsigned DEFAULT NULL,
  `Invoice_Date` date NOT NULL,
  `Date_Actual` date DEFAULT NULL,
  `Complete_Date` date DEFAULT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

INSERT INTO payment VALUES("1","58-0202","1","Milestone Payment","683002.00","25.00","2015-07-15","","");
INSERT INTO payment VALUES("2","58-0202","2","Milestone Payment","2049010.00","75.00","2015-10-21","","");
INSERT INTO payment VALUES("7","15-8297","1","Advance Payment","2700000.00","10.00","2015-03-10","","");
INSERT INTO payment VALUES("8","15-8297","1","Milestone Payment","13500000.00","50.00","2015-07-31","","");
INSERT INTO payment VALUES("9","15-8297","2","Milestone Payment","10800000.00","40.00","2015-11-30","","");
INSERT INTO payment VALUES("10","15-8298","1","Milestone Payment","8000.00","100.00","2015-02-07","","");
INSERT INTO payment VALUES("11","15-8299","1","Milestone Payment","25150.00","100.00","2015-02-20","","");
INSERT INTO payment VALUES("12","15-8300","1","Milestone Payment","190000.00","100.00","2015-02-28","","");
INSERT INTO payment VALUES("13","15-8288","1","Milestone Payment","1377000.00","30.00","2015-01-23","","");
INSERT INTO payment VALUES("14","15-8288","2","Milestone Payment","3213000.00","70.00","2015-06-30","","");
INSERT INTO payment VALUES("15","15-8289","1","Advance Payment","335000.00","10.00","2015-02-05","","");
INSERT INTO payment VALUES("16","15-8289","1","Milestone Payment","2680000.00","80.00","2015-00-00","","");
INSERT INTO payment VALUES("17","15-8289","2","Milestone Payment","335000.00","10.00","2015-08-03","","");
INSERT INTO payment VALUES("18","15-8289 REV.1","1","Advance Payment","335000.00","10.00","2015-01-23","","");
INSERT INTO payment VALUES("19","15-8289 REV.1","1","Milestone Payment","670000.00","20.00","2015-03-31","","");
INSERT INTO payment VALUES("20","15-8289 REV.1","2","Milestone Payment","991600.00","29.60","2015-04-30","","");
INSERT INTO payment VALUES("21","15-8291","1","Milestone Payment","8000.00","100.00","2015-02-03","","");
INSERT INTO payment VALUES("22","15-8295","1","Milestone Payment","595000.00","100.00","2015-02-27","","");
INSERT INTO payment VALUES("23","15-8295 Add#1","1","Milestone Payment","15000.00","100.00","2015-02-27","","");
INSERT INTO payment VALUES("25","15-8302","1","Advance Payment","930000.00","30.00","2015-03-09","","");
INSERT INTO payment VALUES("26","15-8302","1","Milestone Payment","2170000.00","70.00","2015-04-07","","");
INSERT INTO payment VALUES("27","15-8307","1","Milestone Payment","120000.00","100.00","2015-03-04","","");
INSERT INTO payment VALUES("28","15-8289 REV.1","3","Milestone Payment","294800.00","8.80","2015-05-30","","");
INSERT INTO payment VALUES("29","15-8289 REV.1","4","Milestone Payment","402000.00","12.00","2015-06-30","","");
INSERT INTO payment VALUES("30","15-8289 REV.1","5","Milestone Payment","321600.00","9.60","2015-07-31","","");
INSERT INTO payment VALUES("31","15-8289 REV.1","6","Milestone Payment","335000.00","10.00","2015-08-03","","");
INSERT INTO payment VALUES("32","15-8310","1","Milestone Payment","1222640.00","100.00","2015-04-20","","");
INSERT INTO payment VALUES("33","15-8311","1","Milestone Payment","350000.00","100.00","2015-04-20","","");
INSERT INTO payment VALUES("34","58-0208","1","Advance Payment","280374.00","30.00","2015-01-29","","");
INSERT INTO payment VALUES("35","58-0208","1","Milestone Payment","654206.00","70.00","2015-03-31","","");
INSERT INTO payment VALUES("36","58-0203","1","Milestone Payment","13593100.00","90.00","2015-10-31","","");
INSERT INTO payment VALUES("37","58-0203","1","Retention Payment","1510350.00","10.00","2015-10-31","","");
INSERT INTO payment VALUES("38","58-0204","1","Milestone Payment","4402860.00","90.00","2015-10-06","","");
INSERT INTO payment VALUES("39","58-0204","1","Retention Payment","489206.00","10.00","2015-10-06","","");
INSERT INTO payment VALUES("40","15-8314","1","Milestone Payment","50000.00","100.00","2015-05-20","","");
INSERT INTO payment VALUES("41","15-8318","1","Milestone Payment","350000.00","100.00","2015-03-31","","");
INSERT INTO payment VALUES("42","15-8319","1","Milestone Payment","414472.50","100.00","2015-04-22","","");
INSERT INTO payment VALUES("43","15-8321","1","Milestone Payment","8000.00","100.00","2015-03-19","","");
INSERT INTO payment VALUES("44","10-9999","1","Advance Payment","465000.00","10.00","2015-04-01","","");
INSERT INTO payment VALUES("45","10-9999","2","Advance Payment","232500.00","5.00","2015-04-02","","");
INSERT INTO payment VALUES("71","10-9999","3","Advance Payment","465000.00","10.00","2015-04-19","","");



DROP TABLE payment_type;

CREATE TABLE `payment_type` (
  `PTID` int(4) NOT NULL AUTO_INCREMENT,
  `Description` varchar(30) NOT NULL,
  PRIMARY KEY (`PTID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO payment_type VALUES("1","Advance Payment");
INSERT INTO payment_type VALUES("2","Progress Payment");
INSERT INTO payment_type VALUES("3","Milestone Payment");
INSERT INTO payment_type VALUES("4","Retention Payment");



DROP TABLE po_asso;

CREATE TABLE `po_asso` (
  `JID` varchar(20) NOT NULL,
  `Contractor_Name` varchar(100) NOT NULL,
  `PO_No` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`JID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO po_asso VALUES("10-9999","Taro","");
INSERT INTO po_asso VALUES("15-8284","บริษัท พีแอนด์ พีแก๊สเทคเซอร์วิส จำกัด","15/0255");
INSERT INTO po_asso VALUES("15-8285","Chevron Thailand Exploration and Production Ltd.","MASTER CONTRACTOR SERVICES CONTRACT NO.1306396 (REFERENCE ONLY)");
INSERT INTO po_asso VALUES("15-8286","หจก. วิสิทธินนท์ แอนด์ ซัพพลาย","15/0256");
INSERT INTO po_asso VALUES("15-8287","บริษัท ซีโก้ เซอร์วิส แอนด์ เมนเทนแนนซ์ จำกัด","15/022");
INSERT INTO po_asso VALUES("15-8288","EURO-Waste Engineering Co., Ltd.","02");
INSERT INTO po_asso VALUES("15-8289 REV.1","Goshu Kohsan Co., Ltd.","14NB43857-REV.1");
INSERT INTO po_asso VALUES("15-8290","PTT Public Co., Ltd.","3150013471");
INSERT INTO po_asso VALUES("15-8291","Thai Mannings Furnace Co., Ltd.","TMF 15/01004");
INSERT INTO po_asso VALUES("15-8292","บริษัท ออร์คิด แก๊ส (ประเทศไทย) จำกัด","580121/01");
INSERT INTO po_asso VALUES("15-8293","ATG Occupational (Pvt) Ltd.","");
INSERT INTO po_asso VALUES("15-8294","ATG Hand Core (Pvt) LTd.","");
INSERT INTO po_asso VALUES("15-8295","Hitachi Plant Technologies(Thailand) Co., Ltd.","Z15TH00073");
INSERT INTO po_asso VALUES("15-8295 Add#1","Hitachi Plant Technologies(Thailand) Co., Ltd.","Z15TH00115");
INSERT INTO po_asso VALUES("15-8296","บริษัท โอทีซี ซิสเท็ม จำกัด","2015/001");
INSERT INTO po_asso VALUES("15-8297","TPI Polene Public Company Limited","46380 P300-1501");
INSERT INTO po_asso VALUES("15-8298","Thai Mannings Furnace Co., Ltd.","TMF 15/02008");
INSERT INTO po_asso VALUES("15-8299","Siam Steel Structure Co., Ltd.","1502001");
INSERT INTO po_asso VALUES("15-8300","Perz Co., Ltd.","1760/2015");
INSERT INTO po_asso VALUES("15-8301","ห้างหุ้นส่วนจำกัด ป.ทวีการปิโตรเลี่ยม","15/0260");
INSERT INTO po_asso VALUES("15-8302","Bayer Thai Company Limited","2411484896");
INSERT INTO po_asso VALUES("15-8303","บริษัท โอทีซี ซิสเท็ม จำกัด ","2015/002");
INSERT INTO po_asso VALUES("15-8304","Hitachi Plant Technologies (Thailand) Co., Ltd.","Z15TH00234, Z15TH00235");
INSERT INTO po_asso VALUES("15-8305","Thaifab Co.,Ltd","00003-58");
INSERT INTO po_asso VALUES("15-8306","บริษัท โอทีซี ซิสเท็ม จำกัด","P/02015/003");
INSERT INTO po_asso VALUES("15-8307","Bayer Thai Company Limited","2411494115");
INSERT INTO po_asso VALUES("15-8308","บริษัท สตาร์แหลมฉบัง 2014 จำกัด","15/0261");
INSERT INTO po_asso VALUES("15-8309","บริษัท เอสเอ็นแก๊สแอด์ออยล์ จำกัด","15/0258");
INSERT INTO po_asso VALUES("15-8310","PTTEP International Limited","3450010353");
INSERT INTO po_asso VALUES("15-8311","Thai Hirakawa Co.,ltd","P1-2015/0484");
INSERT INTO po_asso VALUES("15-8312","บริษัท จันดีปิยแก๊ส 2008 จำกัด","15/262");
INSERT INTO po_asso VALUES("15-8313","บ.เทพธนาวิน ทัคแก๊ส เอ็นจิเนียริ่ง(44)จำกัด","PoTTE01/58");
INSERT INTO po_asso VALUES("15-8314","Mitsubishi Heavy Industries.,Ltd","MHI-1215-1023SP-R00");
INSERT INTO po_asso VALUES("15-8315","บริษัท สยามแก๊สแอด์ ปีโตรเคมีคัลส์ จำกัด","PO1500372");
INSERT INTO po_asso VALUES("15-8316","บริษัท ซีโก้ เซอร์วิส แอนด์ เมนเทนแนนซ์ จำกัด","Po 15/112");
INSERT INTO po_asso VALUES("15-8317","คุณก๊กบุ้น แซ่ลิ้ม","Po 15/0264");
INSERT INTO po_asso VALUES("15-8318","Siam Steel Structure Co., Ltd.","PO1503009");
INSERT INTO po_asso VALUES("15-8319","P.L.International Pte Ltd.","PLI/WLN/0748/2015");
INSERT INTO po_asso VALUES("15-8320","Unique Gas and Petrochemical Co.,Ltd","PO900580352");
INSERT INTO po_asso VALUES("15-8321","Thai Mannings Furnace Co., Ltd.","TMF 15/03013");
INSERT INTO po_asso VALUES("15-8322","บ.โชคชัยนิวเมติก ซิสเท็ม จำกัด","");
INSERT INTO po_asso VALUES("15-8323","PTT Exploration and Production Public Company Limited","");
INSERT INTO po_asso VALUES("15-8324","CARICALI-PTTEPI OPERATING COMPANY SDN BHD","");
INSERT INTO po_asso VALUES("15-8325","PTT Global Chemical Public Company Limited","1040119801");
INSERT INTO po_asso VALUES("15-8326","HMC Polymers Company Limited","4500055697");
INSERT INTO po_asso VALUES("15-8327","บริษัทออร์คิด แก๊ส (ประเทศไทย)จำกัด","580326/01");
INSERT INTO po_asso VALUES("58-0200","Linde (Thailand) Public Company Limited ","");
INSERT INTO po_asso VALUES("58-0201 Rev#1","Babcock Power (Thailand) Ltd.","BPT000097");
INSERT INTO po_asso VALUES("58-0202","Sterling Deaerator Company","6189-01");
INSERT INTO po_asso VALUES("58-0203","CUEL Limited","CVX50-2101");
INSERT INTO po_asso VALUES("58-0204","CUEL limited","CVX50-2102");
INSERT INTO po_asso VALUES("58-0205","CUEL limited","");
INSERT INTO po_asso VALUES("58-0206","CUEL limited","");
INSERT INTO po_asso VALUES("58-0207","CUEL limited","");
INSERT INTO po_asso VALUES("58-0208","ศิรวัฒน์ผลิตภัณฑ์แก๊ส","SGP 2015/01");
INSERT INTO po_asso VALUES("58-0209","Babcock Power (Thailand) Ltd.","");
INSERT INTO po_asso VALUES("58-0210","Babcock Power (Thailand) Ltd.","");
INSERT INTO po_asso VALUES("58-0211","Taihei  Dengyo  Kaisha,  Ltd.","");
INSERT INTO po_asso VALUES("58-0212","Babcock Power (Thailand) Ltd.","");
INSERT INTO po_asso VALUES("58-0213","Stork Thermeq B.V","P15000302");



DROP TABLE po_type;

CREATE TABLE `po_type` (
  `PTID` int(4) NOT NULL AUTO_INCREMENT,
  `Description` varchar(30) NOT NULL,
  PRIMARY KEY (`PTID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO po_type VALUES("1","Fix Lump Sum");
INSERT INTO po_type VALUES("2","Unit Price");
INSERT INTO po_type VALUES("3","Cost Plus");



DROP TABLE user;

CREATE TABLE `user` (
  `User_Seq` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(32) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Authen` tinyint(4) NOT NULL,
  PRIMARY KEY (`User_Seq`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO user VALUES("1","0c13317a0a241769b9d9bfb488284aaa","boyisboyis","$2y$11$107l6fAZ9pyeydYS8I7z4.1kLjVkohEEGfrYM9yqDhqHmUfTMWDvy","0");
INSERT INTO user VALUES("2","ceffbae36a948e333845f4ba6dcef1b0","admin","$2y$11$mUpUm6h.pkc/lFRsebNfLeLP4ef5Mvsl6OKF318oTJgnecxtrxEMm","0");



