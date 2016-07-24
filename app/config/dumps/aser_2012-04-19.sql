-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: aser
-- ------------------------------------------------------
-- Server version	5.1.49-1ubuntu8.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1435 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1290,1287,NULL,NULL,'admin_build_acl',736,737),(1289,1287,NULL,NULL,'admin_empty_acos',734,735),(1288,1287,NULL,NULL,'admin_index',732,733),(1287,1286,NULL,NULL,'Acos',731,738),(1286,954,NULL,NULL,'Acl',730,775),(1285,1279,NULL,NULL,'delete',727,728),(1284,1279,NULL,NULL,'edit',725,726),(1283,1279,NULL,NULL,'add',723,724),(1282,1279,NULL,NULL,'confirm',721,722),(1281,1279,NULL,NULL,'view',719,720),(1280,1279,NULL,NULL,'index',717,718),(1279,954,NULL,NULL,'Virements',716,729),(1278,1272,NULL,NULL,'delete',713,714),(1277,1272,NULL,NULL,'edit',711,712),(1276,1272,NULL,NULL,'add',709,710),(1274,1272,NULL,NULL,'rapport',705,706),(1275,1272,NULL,NULL,'view',707,708),(1273,1272,NULL,NULL,'index',703,704),(1272,954,NULL,NULL,'Ventes',702,715),(1271,1266,NULL,NULL,'delete',699,700),(1270,1266,NULL,NULL,'edit',697,698),(1268,1266,NULL,NULL,'view',693,694),(1269,1266,NULL,NULL,'add',695,696),(1267,1266,NULL,NULL,'index',691,692),(1265,1260,NULL,NULL,'delete',687,688),(1266,954,NULL,NULL,'Unites',690,701),(1264,1260,NULL,NULL,'edit',685,686),(1263,1260,NULL,NULL,'add',683,684),(1262,1260,NULL,NULL,'view',681,682),(1261,1260,NULL,NULL,'index',679,680),(1260,954,NULL,NULL,'Types',678,689),(1259,1254,NULL,NULL,'delete',675,676),(1258,1254,NULL,NULL,'edit',673,674),(1257,1254,NULL,NULL,'add',671,672),(1256,1254,NULL,NULL,'view',669,670),(1255,1254,NULL,NULL,'index',667,668),(1254,954,NULL,NULL,'TypeServices',666,677),(1253,1248,NULL,NULL,'delete',663,664),(1252,1248,NULL,NULL,'edit',661,662),(1251,1248,NULL,NULL,'add',659,660),(1250,1248,NULL,NULL,'view',657,658),(1249,1248,NULL,NULL,'index',655,656),(1248,954,NULL,NULL,'TypeChambres',654,665),(1247,1241,NULL,NULL,'delete',651,652),(1246,1241,NULL,NULL,'edit',649,650),(1245,1241,NULL,NULL,'add',647,648),(1244,1241,NULL,NULL,'view',645,646),(1243,1241,NULL,NULL,'index',643,644),(1242,1241,NULL,NULL,'rapport',641,642),(1241,954,NULL,NULL,'Transports',640,653),(1240,1235,NULL,NULL,'delete',637,638),(1239,1235,NULL,NULL,'edit',635,636),(1238,1235,NULL,NULL,'add',633,634),(1237,1235,NULL,NULL,'view',631,632),(1236,1235,NULL,NULL,'index',629,630),(1235,954,NULL,NULL,'Tiers',628,639),(1234,1229,NULL,NULL,'delete',625,626),(1233,1229,NULL,NULL,'edit',623,624),(1232,1229,NULL,NULL,'add',621,622),(1231,1229,NULL,NULL,'view',619,620),(1230,1229,NULL,NULL,'index',617,618),(1229,954,NULL,NULL,'Suggestions',616,627),(1228,1223,NULL,NULL,'delete',613,614),(1227,1223,NULL,NULL,'edit',611,612),(1226,1223,NULL,NULL,'add',609,610),(1225,1223,NULL,NULL,'view',607,608),(1224,1223,NULL,NULL,'index',605,606),(1223,954,NULL,NULL,'Stocks',604,615),(1222,1217,NULL,NULL,'delete',601,602),(1221,1217,NULL,NULL,'edit',599,600),(1220,1217,NULL,NULL,'add',597,598),(1219,1217,NULL,NULL,'view',595,596),(1218,1217,NULL,NULL,'index',593,594),(1216,1211,NULL,NULL,'delete',587,588),(1217,954,NULL,NULL,'StockInterdits',592,603),(1215,1211,NULL,NULL,'edit',585,586),(1214,1211,NULL,NULL,'add',583,584),(1213,1211,NULL,NULL,'view',581,582),(1212,1211,NULL,NULL,'index',579,580),(1210,1205,NULL,NULL,'delete',575,576),(1211,954,NULL,NULL,'Services',578,591),(1209,1205,NULL,NULL,'edit',573,574),(1208,1205,NULL,NULL,'add',571,572),(1207,1205,NULL,NULL,'view',569,570),(1206,1205,NULL,NULL,'index',567,568),(1205,954,NULL,NULL,'Sections',566,577),(1204,1198,NULL,NULL,'delete',563,564),(1203,1198,NULL,NULL,'edit',561,562),(1202,1198,NULL,NULL,'add',559,560),(1201,1198,NULL,NULL,'view',557,558),(1200,1198,NULL,NULL,'index',555,556),(1199,1198,NULL,NULL,'rapport',553,554),(1198,954,NULL,NULL,'Salaires',552,565),(1197,1178,NULL,NULL,'delete',535,536),(1195,1178,NULL,NULL,'add',531,532),(1196,1178,NULL,NULL,'edit',533,534),(1194,1178,NULL,NULL,'aff_creator',529,530),(1193,1178,NULL,NULL,'view',527,528),(1192,1178,NULL,NULL,'affectation_delete',525,526),(1191,1178,NULL,NULL,'affectation_add',523,524),(1190,1178,NULL,NULL,'affectation_index',521,522),(1189,1178,NULL,NULL,'index',519,520),(1187,1178,NULL,NULL,'guest',515,516),(1188,1178,NULL,NULL,'tabella',517,518),(1186,1178,NULL,NULL,'state_updater',513,514),(1185,1178,NULL,NULL,'departure_changer',511,512),(1184,1178,NULL,NULL,'room_changer',509,510),(1183,1178,NULL,NULL,'extras',507,508),(1182,1178,NULL,NULL,'occupation',505,506),(1181,1178,NULL,NULL,'details',503,504),(1180,1178,NULL,NULL,'client',501,502),(1179,1178,NULL,NULL,'rapport',499,500),(1178,954,NULL,NULL,'Reservations',498,551),(1177,1174,NULL,NULL,'delete',493,494),(1176,1174,NULL,NULL,'add',491,492),(1175,1174,NULL,NULL,'index',489,490),(1173,1165,NULL,NULL,'delete',485,486),(1174,954,NULL,NULL,'Remboursements',488,497),(1172,1165,NULL,NULL,'edit',483,484),(1171,1165,NULL,NULL,'add',481,482),(1170,1165,NULL,NULL,'ingredients',479,480),(1169,1165,NULL,NULL,'add_plat',477,478),(1168,1165,NULL,NULL,'updateProduit',475,476),(1167,1165,NULL,NULL,'view',473,474),(1166,1165,NULL,NULL,'index',471,472),(1165,954,NULL,NULL,'Relations',470,487),(1164,1154,NULL,NULL,'add',447,448),(1163,1154,NULL,NULL,'autoComplete',445,446),(1162,1154,NULL,NULL,'activated',443,444),(1161,1154,NULL,NULL,'list_produits',441,442),(1160,1154,NULL,NULL,'removal',439,440),(1159,1154,NULL,NULL,'paiement',437,438),(1158,1154,NULL,NULL,'print_facture',435,436),(1157,1154,NULL,NULL,'update_produits',433,434),(1156,1154,NULL,NULL,'index',431,432),(1155,1154,NULL,NULL,'rapport',429,430),(1154,954,NULL,NULL,'Recettes',428,469),(1153,1148,NULL,NULL,'delete',425,426),(1152,1148,NULL,NULL,'edit',423,424),(1151,1148,NULL,NULL,'add',421,422),(1150,1148,NULL,NULL,'view',419,420),(1149,1148,NULL,NULL,'index',417,418),(1148,954,NULL,NULL,'Proprietaires',416,427),(1147,1135,NULL,NULL,'upload',403,404),(1146,1135,NULL,NULL,'copy',401,402),(1145,1135,NULL,NULL,'delete',399,400),(1144,1135,NULL,NULL,'deleteAll',397,398),(1143,1135,NULL,NULL,'edit',395,396),(1142,1135,NULL,NULL,'add',393,394),(1141,1135,NULL,NULL,'view',391,392),(1140,1135,NULL,NULL,'index',389,390),(1139,1135,NULL,NULL,'rapport',387,388),(1138,1135,NULL,NULL,'updateGroupe',385,386),(1137,1135,NULL,NULL,'autoComplete',383,384),(1135,954,NULL,NULL,'Produits',380,415),(1136,1135,NULL,NULL,'stock',381,382),(1134,1129,NULL,NULL,'delete',377,378),(1133,1129,NULL,NULL,'edit',375,376),(1132,1129,NULL,NULL,'add',373,374),(1131,1129,NULL,NULL,'view',371,372),(1130,1129,NULL,NULL,'index',369,370),(1129,954,NULL,NULL,'Prets',368,379),(1128,1122,NULL,NULL,'delete',365,366),(1127,1122,NULL,NULL,'edit',363,364),(1126,1122,NULL,NULL,'add',361,362),(1125,1122,NULL,NULL,'view',359,360),(1124,1122,NULL,NULL,'index',357,358),(1123,1122,NULL,NULL,'rapport',355,356),(1122,954,NULL,NULL,'PretOperations',354,367),(1121,1115,NULL,NULL,'delete',351,352),(1120,1115,NULL,NULL,'edit',349,350),(1119,1115,NULL,NULL,'add',347,348),(1118,1115,NULL,NULL,'view',345,346),(1117,1115,NULL,NULL,'rapport',343,344),(1116,1115,NULL,NULL,'index',341,342),(1115,954,NULL,NULL,'Pertes',340,353),(1114,1106,NULL,NULL,'buildAcl',335,336),(1113,1106,NULL,NULL,'delete',333,334),(1112,1106,NULL,NULL,'edit',331,332),(1111,1106,NULL,NULL,'add',329,330),(1110,1106,NULL,NULL,'view',327,328),(1109,1106,NULL,NULL,'index',325,326),(1108,1106,NULL,NULL,'logout',323,324),(1107,1106,NULL,NULL,'login',321,322),(1106,954,NULL,NULL,'Personnels',320,339),(1105,1099,NULL,NULL,'delete',317,318),(1104,1099,NULL,NULL,'edit',315,316),(1103,1099,NULL,NULL,'add',313,314),(1102,1099,NULL,NULL,'confirm',311,312),(1100,1099,NULL,NULL,'index',307,308),(1101,1099,NULL,NULL,'view',309,310),(1099,954,NULL,NULL,'Mouvements',306,319),(1098,1093,NULL,NULL,'delete',303,304),(1097,1093,NULL,NULL,'edit',301,302),(1096,1093,NULL,NULL,'add',299,300),(1095,1093,NULL,NULL,'view',297,298),(1094,1093,NULL,NULL,'index',295,296),(1092,1087,NULL,NULL,'delete',291,292),(1093,954,NULL,NULL,'LocationTransports',294,305),(1091,1087,NULL,NULL,'edit',289,290),(1090,1087,NULL,NULL,'add',287,288),(1089,1087,NULL,NULL,'view',285,286),(1088,1087,NULL,NULL,'index',283,284),(1087,954,NULL,NULL,'Lettres',282,293),(1086,1080,NULL,NULL,'deleteall',279,280),(1085,1080,NULL,NULL,'delete',277,278),(1084,1080,NULL,NULL,'edit',275,276),(1083,1080,NULL,NULL,'add',273,274),(1082,1080,NULL,NULL,'view',271,272),(1081,1080,NULL,NULL,'index',269,270),(1079,1074,NULL,NULL,'delete',265,266),(1080,954,NULL,NULL,'Groupes',268,281),(1077,1074,NULL,NULL,'add',261,262),(1078,1074,NULL,NULL,'edit',263,264),(1076,1074,NULL,NULL,'view',259,260),(1075,1074,NULL,NULL,'index',257,258),(1074,954,NULL,NULL,'Fonctions',256,267),(1073,1068,NULL,NULL,'edit',245,246),(1072,1068,NULL,NULL,'view',243,244),(1071,1068,NULL,NULL,'index',241,242),(1070,1068,NULL,NULL,'remove_facture',239,240),(1069,1068,NULL,NULL,'create_facture',237,238),(1068,954,NULL,NULL,'Factures',236,255),(1067,1061,NULL,NULL,'delete',233,234),(1066,1061,NULL,NULL,'edit',231,232),(1065,1061,NULL,NULL,'add',229,230),(1064,1061,NULL,NULL,'view',227,228),(1063,1061,NULL,NULL,'index',225,226),(1062,1061,NULL,NULL,'rapport',223,224),(1061,954,NULL,NULL,'Entretiens',222,235),(1060,1055,NULL,NULL,'delete',219,220),(1059,1055,NULL,NULL,'edit',217,218),(1058,1055,NULL,NULL,'add',215,216),(1057,1055,NULL,NULL,'view',213,214),(1056,1055,NULL,NULL,'index',211,212),(1055,954,NULL,NULL,'EntretienChambres',210,221),(1054,1049,NULL,NULL,'delete',207,208),(1053,1049,NULL,NULL,'edit',205,206),(1052,1049,NULL,NULL,'add',203,204),(1051,1049,NULL,NULL,'view',201,202),(1050,1049,NULL,NULL,'index',199,200),(1049,954,NULL,NULL,'Dotations',198,209),(1048,1043,NULL,NULL,'delete',193,194),(1047,1043,NULL,NULL,'edit',191,192),(1046,1043,NULL,NULL,'add',189,190),(1045,1043,NULL,NULL,'view',187,188),(1044,1043,NULL,NULL,'index',185,186),(1043,954,NULL,NULL,'Dettes',184,197),(1042,1037,NULL,NULL,'delete',181,182),(1041,1037,NULL,NULL,'edit',179,180),(1040,1037,NULL,NULL,'add',177,178),(1039,1037,NULL,NULL,'view',175,176),(1038,1037,NULL,NULL,'index',173,174),(1037,954,NULL,NULL,'Conversions',172,183),(1036,1031,NULL,NULL,'delete',169,170),(1035,1031,NULL,NULL,'edit',167,168),(1034,1031,NULL,NULL,'add',165,166),(1033,1031,NULL,NULL,'view',163,164),(1032,1031,NULL,NULL,'index',161,162),(1031,954,NULL,NULL,'Containeurs',160,171),(1030,1026,NULL,NULL,'backup',157,158),(1029,1026,NULL,NULL,'uploadFiles',155,156),(1028,1026,NULL,NULL,'index',153,154),(1027,1026,NULL,NULL,'defaulter',151,152),(1026,954,NULL,NULL,'Configs',150,159),(1025,1022,NULL,NULL,'view',147,148),(1024,1022,NULL,NULL,'index',145,146),(1023,1022,NULL,NULL,'create_commande',143,144),(1022,954,NULL,NULL,'Commandes',142,149),(1021,1016,NULL,NULL,'delete',139,140),(1020,1016,NULL,NULL,'edit',137,138),(1019,1016,NULL,NULL,'add',135,136),(1018,1016,NULL,NULL,'view',133,134),(1017,1016,NULL,NULL,'index',131,132),(1016,954,NULL,NULL,'Cochauffeurs',130,141),(1015,1009,NULL,NULL,'delete',127,128),(1014,1009,NULL,NULL,'edit',125,126),(1013,1009,NULL,NULL,'add',123,124),(1012,1009,NULL,NULL,'view',121,122),(1011,1009,NULL,NULL,'index',119,120),(1010,1009,NULL,NULL,'rapport',117,118),(1009,954,NULL,NULL,'Chauffeurs',116,129),(1008,1003,NULL,NULL,'delete',113,114),(1007,1003,NULL,NULL,'edit',111,112),(1006,1003,NULL,NULL,'add',109,110),(1005,1003,NULL,NULL,'view',107,108),(1004,1003,NULL,NULL,'index',105,106),(1003,954,NULL,NULL,'Chambres',104,115),(1002,997,NULL,NULL,'delete',101,102),(1001,997,NULL,NULL,'edit',99,100),(1000,997,NULL,NULL,'add',97,98),(999,997,NULL,NULL,'view',95,96),(998,997,NULL,NULL,'index',93,94),(997,954,NULL,NULL,'Carburants',92,103),(996,991,NULL,NULL,'delete',89,90),(995,991,NULL,NULL,'edit',87,88),(994,991,NULL,NULL,'add',85,86),(993,991,NULL,NULL,'view',83,84),(992,991,NULL,NULL,'index',81,82),(991,954,NULL,NULL,'Camions',80,91),(990,985,NULL,NULL,'delete',75,76),(989,985,NULL,NULL,'edit',73,74),(988,985,NULL,NULL,'add',71,72),(987,985,NULL,NULL,'view',69,70),(986,985,NULL,NULL,'index',67,68),(985,954,NULL,NULL,'Caisses',66,79),(984,978,NULL,NULL,'delete',61,62),(983,978,NULL,NULL,'edit',59,60),(982,978,NULL,NULL,'add',57,58),(981,978,NULL,NULL,'view',55,56),(980,978,NULL,NULL,'index',53,54),(979,978,NULL,NULL,'rapport',51,52),(978,954,NULL,NULL,'CaisseOperations',50,65),(977,972,NULL,NULL,'delete',47,48),(976,972,NULL,NULL,'edit',45,46),(975,972,NULL,NULL,'add',43,44),(974,972,NULL,NULL,'view',41,42),(973,972,NULL,NULL,'index',39,40),(972,954,NULL,NULL,'CaisseInterdites',38,49),(971,967,NULL,NULL,'view',35,36),(970,967,NULL,NULL,'index',33,34),(969,967,NULL,NULL,'remove_bon',31,32),(968,967,NULL,NULL,'create_bon',29,30),(967,954,NULL,NULL,'Bons',28,37),(966,960,NULL,NULL,'delete',25,26),(965,960,NULL,NULL,'edit',23,24),(964,960,NULL,NULL,'add',21,22),(963,960,NULL,NULL,'view',19,20),(962,960,NULL,NULL,'rapport',17,18),(961,960,NULL,NULL,'index',15,16),(960,954,NULL,NULL,'Approvisionements',14,27),(959,957,NULL,NULL,'view',9,10),(958,957,NULL,NULL,'index',7,8),(957,954,NULL,NULL,'Affectations',6,13),(956,955,NULL,NULL,'index',3,4),(955,954,NULL,NULL,'Activities',2,5),(954,NULL,NULL,NULL,'controllers',1,962),(1291,1286,NULL,NULL,'Aros',739,774),(1292,1291,NULL,NULL,'admin_index',740,741),(1293,1291,NULL,NULL,'admin_check',742,743),(1294,1291,NULL,NULL,'admin_users',744,745),(1295,1291,NULL,NULL,'admin_update_user_role',746,747),(1296,1291,NULL,NULL,'admin_ajax_role_permissions',748,749),(1297,1291,NULL,NULL,'admin_role_permissions',750,751),(1298,1291,NULL,NULL,'admin_user_permissions',752,753),(1299,1291,NULL,NULL,'admin_empty_permissions',754,755),(1300,1291,NULL,NULL,'admin_clear_user_specific_permissions',756,757),(1301,1291,NULL,NULL,'admin_grant_all_controllers',758,759),(1302,1291,NULL,NULL,'admin_deny_all_controllers',760,761),(1303,1291,NULL,NULL,'admin_get_role_controller_permission',762,763),(1304,1291,NULL,NULL,'admin_grant_role_permission',764,765),(1305,1291,NULL,NULL,'admin_deny_role_permission',766,767),(1306,1291,NULL,NULL,'admin_get_user_controller_permission',768,769),(1307,1291,NULL,NULL,'admin_grant_user_permission',770,771),(1308,1291,NULL,NULL,'admin_deny_user_permission',772,773),(1309,954,NULL,NULL,'Pages',776,779),(1310,1309,NULL,NULL,'display',777,778),(1311,1154,NULL,NULL,'edit_produit',449,450),(1312,1154,NULL,NULL,'cloturer',451,452),(1313,1154,NULL,NULL,'journal',453,454),(1314,1154,NULL,NULL,'serveur',455,456),(1315,1178,NULL,NULL,'extras',537,538),(1316,1068,NULL,NULL,'multi_remove',247,248),(1317,954,NULL,NULL,'Journals',780,791),(1318,1317,NULL,NULL,'index',781,782),(1319,1317,NULL,NULL,'view',783,784),(1320,1317,NULL,NULL,'add',785,786),(1321,1317,NULL,NULL,'edit',787,788),(1322,1317,NULL,NULL,'delete',789,790),(1323,1135,NULL,NULL,'stuff',405,406),(1324,1178,NULL,NULL,'occupants_changer',539,540),(1325,1178,NULL,NULL,'availability',541,542),(1326,1068,NULL,NULL,'customer_changer',249,250),(1327,1135,NULL,NULL,'category',407,408),(1328,954,NULL,NULL,'Online',792,797),(1329,1328,NULL,NULL,'Onlines',793,796),(1330,1329,NULL,NULL,'index',794,795),(1331,1106,NULL,NULL,'buildacl',337,338),(1332,1178,NULL,NULL,'price_updater',543,544),(1333,954,NULL,NULL,'Etages',798,799),(1334,954,NULL,NULL,'Etages',800,801),(1335,954,NULL,NULL,'Etages',802,803),(1336,954,NULL,NULL,'Etages',804,805),(1337,954,NULL,NULL,'Etages',806,807),(1338,954,NULL,NULL,'Etages',808,821),(1339,1338,NULL,NULL,'all',809,810),(1340,1338,NULL,NULL,'index',811,812),(1341,1338,NULL,NULL,'edit',813,814),(1342,1338,NULL,NULL,'view',815,816),(1343,1338,NULL,NULL,'delete',817,818),(1344,1338,NULL,NULL,'add',819,820),(1345,1154,NULL,NULL,'consommations',457,458),(1346,954,NULL,NULL,'ReservationTraces',822,827),(1347,1346,NULL,NULL,'index',823,824),(1348,1346,NULL,NULL,'index',825,826),(1349,1178,NULL,NULL,'demi',545,546),(1350,1178,NULL,NULL,'monthly',547,548),(1351,957,NULL,NULL,'history',11,12),(1352,1174,NULL,NULL,'mass_payment',495,496),(1353,1211,NULL,NULL,'rapport',589,590),(1354,978,NULL,NULL,'updateType',63,64),(1355,1068,NULL,NULL,'date_emission',251,252),(1356,954,NULL,NULL,'ProduitDetails',828,831),(1357,1356,NULL,NULL,'index',829,830),(1358,954,NULL,NULL,'Proformas',832,843),(1359,1358,NULL,NULL,'add',833,834),(1360,1358,NULL,NULL,'edit',835,836),(1361,1358,NULL,NULL,'view',837,838),(1362,1358,NULL,NULL,'delete',839,840),(1363,1358,NULL,NULL,'index',841,842),(1364,954,NULL,NULL,'Locations',844,863),(1365,1364,NULL,NULL,'all',845,846),(1366,1364,NULL,NULL,'index',847,848),(1367,1364,NULL,NULL,'edit',849,850),(1368,1364,NULL,NULL,'delete',851,852),(1369,1364,NULL,NULL,'view',853,854),(1370,1364,NULL,NULL,'add',855,856),(1371,954,NULL,NULL,'Salles',864,875),(1372,1371,NULL,NULL,'index',865,866),(1373,1371,NULL,NULL,'add',867,868),(1374,1371,NULL,NULL,'edit',869,870),(1375,1371,NULL,NULL,'delete',871,872),(1376,1371,NULL,NULL,'view',873,874),(1377,954,NULL,NULL,'locationExtras',876,877),(1378,954,NULL,NULL,'LocationExtras',878,889),(1379,1378,NULL,NULL,'index',879,880),(1380,1378,NULL,NULL,'add',881,882),(1381,1378,NULL,NULL,'edit',883,884),(1382,1378,NULL,NULL,'view',885,886),(1383,1378,NULL,NULL,'delete',887,888),(1384,1364,NULL,NULL,'extra_index',857,858),(1385,1364,NULL,NULL,'extra_add',859,860),(1386,1364,NULL,NULL,'extra_delete',861,862),(1387,1068,NULL,NULL,'rapport',253,254),(1388,954,NULL,NULL,'Comptes',890,909),(1389,1388,NULL,NULL,'index',891,892),(1390,1388,NULL,NULL,'view',893,894),(1391,1388,NULL,NULL,'add',895,896),(1392,1388,NULL,NULL,'edit',897,898),(1393,1388,NULL,NULL,'delete',899,900),(1394,954,NULL,NULL,'Historiques',910,921),(1395,1394,NULL,NULL,'delete',911,912),(1396,1394,NULL,NULL,'add',913,914),(1397,1394,NULL,NULL,'edit',915,916),(1398,1394,NULL,NULL,'view',917,918),(1399,1394,NULL,NULL,'index',919,920),(1400,954,NULL,NULL,'Immobilisations',922,937),(1401,1400,NULL,NULL,'add',923,924),(1402,1400,NULL,NULL,'edit',925,926),(1403,1400,NULL,NULL,'view',927,928),(1404,1400,NULL,NULL,'edit',929,930),(1405,1400,NULL,NULL,'delete',931,932),(1406,1400,NULL,NULL,'index',933,934),(1407,954,NULL,NULL,'TypeImmobilisations',938,949),(1408,1407,NULL,NULL,'index',939,940),(1409,1407,NULL,NULL,'view',941,942),(1410,1407,NULL,NULL,'add',943,944),(1411,1407,NULL,NULL,'edit',945,946),(1412,1407,NULL,NULL,'delete',947,948),(1413,1135,NULL,NULL,'detail_index',409,410),(1414,1135,NULL,NULL,'detail_add',411,412),(1415,1135,NULL,NULL,'detail_delete',413,414),(1416,1043,NULL,NULL,'rapport',195,196),(1417,1178,NULL,NULL,'etat_occupation',549,550),(1418,985,NULL,NULL,'sum',77,78),(1419,1400,NULL,NULL,'rapport',935,936),(1420,954,NULL,NULL,'Bilans',950,961),(1421,1420,NULL,NULL,'index',951,952),(1422,1420,NULL,NULL,'view',953,954),(1423,1420,NULL,NULL,'create',955,956),(1424,1420,NULL,NULL,'cloturer',957,958),(1425,1388,NULL,NULL,'historique',901,902),(1426,1154,NULL,NULL,'lastFactureId',459,460),(1427,1154,NULL,NULL,'print_bon',461,462),(1428,1154,NULL,NULL,'recette',463,464),(1429,1154,NULL,NULL,'detail_index',465,466),(1430,1154,NULL,NULL,'combobox',467,468),(1431,1388,NULL,NULL,'balance',903,904),(1432,1388,NULL,NULL,'init_compte',905,906),(1433,1420,NULL,NULL,'delete',959,960),(1434,1388,NULL,NULL,'cloturer',907,908);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acquisitions`
--

DROP TABLE IF EXISTS `acquisitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acquisitions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) DEFAULT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `immobilisiation_id` bigint(20) NOT NULL,
  `montant` double NOT NULL,
  `date` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acquisitions`
--

LOCK TABLES `acquisitions` WRITE;
/*!40000 ALTER TABLE `acquisitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `acquisitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `affectations`
--

DROP TABLE IF EXISTS `affectations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `affectations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint(20) NOT NULL,
  `chambre_id` bigint(20) NOT NULL,
  `tier_id` bigint(20) NOT NULL,
  `etat` varchar(50) NOT NULL,
  `entree` date DEFAULT NULL,
  `sortie` date DEFAULT NULL,
  `commentaire` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affectations`
--

LOCK TABLES `affectations` WRITE;
/*!40000 ALTER TABLE `affectations` DISABLE KEYS */;
INSERT INTO `affectations` VALUES (1,1,1,2,'','2012-03-01','2012-03-06','',11,'2012-03-30 09:47:45','2012-03-30 09:47:45'),(5,2,4,3,'in','2012-03-04','2012-04-11','',11,'2012-03-31 10:58:19','2012-03-31 11:00:43'),(4,2,4,1,'in','2012-03-04','2012-04-11','',11,'2012-03-31 10:58:19','2012-03-31 11:00:43'),(6,3,1,3,'','2012-03-10','2012-03-13','',11,'2012-03-31 11:02:44','2012-03-31 11:03:58'),(7,4,3,2,'','2012-03-22','2012-03-31','',11,'2012-03-31 11:19:08','2012-03-31 11:19:08'),(8,5,5,5,'','2012-04-01','2012-04-12','',11,'2012-04-05 19:30:29','2012-04-05 19:30:29'),(9,6,2,5,'','2012-04-05','2012-04-11','',11,'2012-04-09 12:12:09','2012-04-09 12:12:09'),(10,7,2,9,'','2012-04-08','2012-05-02','',11,'2012-04-09 13:03:38','2012-04-09 13:57:30'),(11,8,6,5,'','2012-04-19','2012-04-27','',11,'2012-04-09 13:14:08','2012-04-09 13:14:08'),(12,9,3,10,'','2012-04-14','2012-04-18','',11,'2012-04-09 13:17:24','2012-04-09 14:02:14'),(13,10,6,1,'','2012-04-07','2012-04-14','',11,'2012-04-10 15:16:07','2012-04-10 15:16:07'),(14,11,1,11,'','2012-04-01','2012-04-03','',0,'2012-04-11 14:22:53','2012-04-11 14:22:53'),(15,13,1,11,'','2012-04-11','2012-04-11','',0,'2012-04-11 16:11:10','2012-04-11 16:11:10'),(16,14,1,11,'','2012-04-04','2012-04-06','',0,'2012-04-11 16:38:25','2012-04-11 16:38:25'),(17,15,3,11,'','2012-04-01','2012-04-03','',0,'2012-04-11 16:51:02','2012-04-11 16:51:02'),(18,16,3,11,'','2012-04-04','2012-04-06','',0,'2012-04-11 16:52:40','2012-04-11 16:52:40');
/*!40000 ALTER TABLE `affectations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amortissements`
--

DROP TABLE IF EXISTS `amortissements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amortissements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `immobilisation_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `dotation` double NOT NULL,
  `anterieure` double NOT NULL,
  `cumul` double NOT NULL,
  `VNC` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amortissements`
--

LOCK TABLES `amortissements` WRITE;
/*!40000 ALTER TABLE `amortissements` DISABLE KEYS */;
/*!40000 ALTER TABLE `amortissements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvisionements`
--

DROP TABLE IF EXISTS `approvisionements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvisionements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) DEFAULT NULL,
  `commande_id` bigint(20) DEFAULT NULL,
  `bon_id` bigint(20) DEFAULT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `produit_id` bigint(20) unsigned NOT NULL,
  `quantite` bigint(255) NOT NULL,
  `unite_id` bigint(20) DEFAULT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `echange` varchar(50) NOT NULL,
  `date1` date DEFAULT NULL,
  `batch` double DEFAULT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvisionements`
--

LOCK TABLES `approvisionements` WRITE;
/*!40000 ALTER TABLE `approvisionements` DISABLE KEYS */;
INSERT INTO `approvisionements` VALUES (1,4,NULL,1,NULL,28161,10,4,600,6000,'BIF','non','2012-03-24',NULL,11,'2012-03-24 21:43:52','2012-03-24 21:44:24'),(2,6,NULL,2,NULL,28168,10,4,450,4500,'BIF','non','2012-04-07',NULL,11,'2012-04-07 19:48:49','2012-04-07 19:49:44'),(3,6,NULL,2,NULL,28165,10,4,1000,10000,'BIF','non','2012-04-07',NULL,11,'2012-04-07 19:49:21','2012-04-07 19:49:44'),(4,7,NULL,3,NULL,28168,1,2,6000,6000,'BIF','non','2012-04-05',NULL,11,'2012-04-07 19:56:36','2012-04-07 19:57:22'),(5,6,NULL,4,NULL,25,1,2,1000,1000,'BIF','non','2012-04-04',NULL,11,'2012-04-07 20:10:15','2012-04-07 20:10:53'),(6,8,NULL,5,NULL,5,1,2,0,0,'BIF','non','2012-04-02',NULL,11,'2012-04-07 20:23:19','2012-04-07 20:24:01'),(7,8,NULL,6,124,28169,3,4,500,1500,'BIF','non','2012-04-13',NULL,11,'2012-04-13 08:08:41','2012-04-13 08:16:01'),(8,12,NULL,7,125,28169,7,4,500,3500,'BIF','non','2012-04-13',NULL,11,'2012-04-13 08:39:15','2012-04-13 08:47:57'),(9,13,NULL,8,126,21,1,4,6579,6579,'BIF','non','2012-04-13',78755432,35,'2012-04-13 10:13:00','2012-04-13 10:17:41'),(10,13,1,10,133,28169,1,2,1000,1000,'BIF','non','2012-04-14',NULL,11,'2012-04-14 12:28:22','2012-04-14 12:42:29');
/*!40000 ALTER TABLE `approvisionements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Fonction',1,NULL,1,34),(3,1,'Personnel',3,NULL,4,5),(4,1,'Personnel',4,NULL,2,3),(5,NULL,'Fonction',2,NULL,35,46),(6,1,'Personnel',5,NULL,6,7),(7,1,'Personnel',6,NULL,8,9),(8,1,'Personnel',7,NULL,10,11),(9,1,'Personnel',8,NULL,12,13),(10,1,'Personnel',9,NULL,14,15),(11,5,'Personnel',10,NULL,36,37),(12,NULL,'Fonction',3,NULL,47,50),(13,12,'Personnel',11,NULL,48,49),(14,5,'Personnel',12,NULL,38,39),(15,1,'Personnel',13,NULL,16,17),(16,1,'Personnel',14,NULL,18,19),(17,5,'Personnel',15,NULL,40,41),(18,1,'Personnel',16,NULL,20,21),(19,1,'Personnel',17,NULL,22,23),(20,1,'Personnel',18,NULL,24,25),(21,NULL,'Fonction',4,NULL,51,62),(22,21,'Personnel',19,NULL,52,53),(23,21,'Personnel',20,NULL,54,55),(24,21,'Personnel',21,NULL,56,57),(25,21,'Personnel',22,NULL,58,59),(26,21,'Personnel',23,NULL,60,61),(27,NULL,'Fonction',5,NULL,63,74),(28,27,'Personnel',24,NULL,64,65),(29,27,'Personnel',25,NULL,66,67),(30,1,'Personnel',26,NULL,26,27),(31,NULL,'Fonction',6,NULL,75,78),(32,31,'Personnel',27,NULL,76,77),(33,27,'Personnel',28,NULL,68,69),(34,5,'Personnel',29,NULL,42,43),(35,5,'Personnel',30,NULL,44,45),(36,1,'Personnel',31,NULL,28,29),(37,1,'Personnel',32,NULL,30,31),(38,1,'Personnel',33,NULL,32,33),(40,27,'Personnel',35,NULL,70,71),(41,27,'Personnel',36,NULL,72,73);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (2,5,1226,'1','1','1','1'),(3,1,1226,'-1','-1','-1','-1'),(4,1,1270,'-1','-1','-1','-1'),(7,1,1228,'-1','-1','-1','-1'),(5,5,1449,'-1','-1','-1','-1'),(6,1,1417,'1','1','1','1'),(8,4,1228,'1','1','1','1'),(10,5,954,'-1','-1','-1','-1'),(11,12,954,'1','1','1','1'),(12,1,954,'-1','-1','-1','-1'),(13,5,989,'-1','-1','-1','-1'),(14,5,990,'-1','-1','-1','-1'),(15,5,988,'-1','-1','-1','-1'),(16,21,954,'-1','-1','-1','-1'),(17,21,1248,'1','1','1','1'),(18,21,1003,'1','1','1','1'),(19,21,1178,'1','1','1','1'),(20,21,957,'1','1','1','1'),(21,21,1229,'1','1','1','1'),(22,21,1049,'1','1','1','1'),(23,21,1061,'1','1','1','1'),(24,21,1309,'1','1','1','1'),(25,21,1068,'1','1','1','1'),(26,21,1235,'1','1','1','1'),(27,21,1211,'1','1','1','1'),(28,21,1254,'1','1','1','1'),(29,21,978,'1','1','1','1'),(30,5,1154,'1','1','1','1'),(31,5,1135,'1','1','1','1'),(32,5,978,'1','1','1','1'),(33,5,1068,'1','1','1','1'),(34,5,1235,'1','1','1','1'),(35,5,1309,'1','1','1','1'),(36,5,1043,'1','1','1','1'),(37,5,1174,'1','1','1','1'),(38,21,1174,'1','1','1','1'),(39,21,1043,'1','1','1','1'),(40,5,1177,'-1','-1','-1','-1'),(41,21,1177,'-1','-1','-1','-1'),(42,27,954,'1','1','1','1'),(148,27,996,'-1','-1','-1','-1'),(54,27,995,'-1','-1','-1','-1'),(55,27,1002,'-1','-1','-1','-1'),(56,27,1001,'-1','-1','-1','-1'),(151,21,1135,'1','1','1','1'),(150,5,1155,'-1','-1','-1','-1'),(182,28,1350,'1','1','1','1'),(181,27,1350,'-1','-1','-1','-1'),(180,29,1350,'-1','-1','-1','-1'),(179,31,1350,'-1','-1','-1','-1'),(178,21,1350,'-1','-1','-1','-1'),(177,31,954,'1','1','1','1'),(176,21,1348,'1','1','1','1'),(175,21,1338,'1','1','1','1'),(70,27,1322,'-1','-1','-1','-1'),(71,27,1321,'-1','-1','-1','-1'),(174,21,1332,'-1','-1','-1','-1'),(171,21,1145,'-1','-1','-1','-1'),(75,27,1114,'-1','-1','-1','-1'),(170,5,1145,'-1','-1','-1','-1'),(169,21,1326,'-1','-1','-1','-1'),(168,5,1326,'-1','-1','-1','-1'),(167,21,1045,'-1','-1','-1','-1'),(153,21,1154,'-1','-1','-1','-1'),(152,21,960,'1','1','1','1'),(154,21,1272,'1','1','1','1'),(155,21,1026,'1','1','1','1'),(86,27,1164,'-1','-1','-1','-1'),(91,27,1163,'-1','-1','-1','-1'),(88,27,1312,'-1','-1','-1','-1'),(89,27,1311,'-1','-1','-1','-1'),(166,5,1045,'-1','-1','-1','-1'),(156,21,967,'1','1','1','1'),(157,12,1106,'0','0','0','0'),(158,5,1046,'-1','-1','-1','-1'),(159,21,1046,'-1','-1','-1','-1'),(160,5,1048,'-1','-1','-1','-1'),(161,21,1048,'-1','-1','-1','-1'),(162,21,1047,'-1','-1','-1','-1'),(163,5,1047,'-1','-1','-1','-1'),(164,5,1044,'-1','-1','-1','-1'),(165,21,1044,'-1','-1','-1','-1'),(112,27,1294,'-1','-1','-1','-1'),(113,27,1298,'-1','-1','-1','-1'),(114,27,1295,'-1','-1','-1','-1'),(115,27,1297,'-1','-1','-1','-1'),(116,27,1292,'-1','-1','-1','-1'),(117,27,1307,'-1','-1','-1','-1'),(118,27,1288,'-1','-1','-1','-1'),(119,27,1296,'-1','-1','-1','-1'),(120,27,1293,'-1','-1','-1','-1'),(121,27,1300,'-1','-1','-1','-1'),(122,27,1302,'-1','-1','-1','-1'),(123,27,1305,'-1','-1','-1','-1'),(124,27,1299,'-1','-1','-1','-1'),(125,27,1308,'-1','-1','-1','-1'),(126,27,1303,'-1','-1','-1','-1'),(127,27,1306,'-1','-1','-1','-1'),(128,27,1301,'-1','-1','-1','-1'),(129,27,1304,'-1','-1','-1','-1'),(130,27,1290,'-1','-1','-1','-1'),(131,27,1289,'-1','-1','-1','-1'),(132,27,1135,'1','1','1','1'),(133,27,960,'1','1','1','1'),(134,27,1272,'1','1','1','1'),(135,27,1037,'1','1','1','1'),(136,27,1266,'1','1','1','1'),(137,27,1115,'1','1','1','1'),(138,27,1165,'1','1','1','1'),(139,27,1043,'1','1','1','1'),(140,27,1129,'1','1','1','1'),(141,27,1122,'1','1','1','1'),(142,27,1099,'1','1','1','1'),(143,27,1022,'1','1','1','1'),(144,27,967,'1','1','1','1'),(145,27,1205,'1','1','1','1'),(146,27,1223,'1','1','1','1'),(147,27,1080,'1','1','1','1'),(183,12,1135,'1','1','1','1'),(186,21,1364,'1','1','1','1'),(187,1,1154,'1','1','1','1'),(188,1,1309,'1','1','1','1'),(189,1,1313,'-1','-1','-1','-1'),(190,1,1345,'-1','-1','-1','-1'),(191,1,1155,'-1','-1','-1','-1'),(192,1,1159,'-1','-1','-1','-1'),(193,1,1158,'-1','-1','-1','-1'),(194,1,1314,'-1','-1','-1','-1'),(195,1,1311,'-1','-1','-1','-1'),(196,1,1312,'-1','-1','-1','-1'),(197,1,1160,'1','1','1','1'),(198,5,1413,'1','1','1','1'),(199,5,1414,'-1','-1','-1','-1'),(200,5,1415,'-1','-1','-1','-1'),(201,5,1070,'-1','-1','-1','-1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bilans`
--

DROP TABLE IF EXISTS `bilans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bilans` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `details` text NOT NULL,
  `date` date NOT NULL,
  `personnel_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bilans`
--

LOCK TABLES `bilans` WRITE;
/*!40000 ALTER TABLE `bilans` DISABLE KEYS */;
INSERT INTO `bilans` VALUES (1,'resultat => 0, actif => 108450349.96, dettes => 13579, immobs => Immeubles : 100000000; Materiels : 5000000; Mobilier : 1000000, marchandises => 168109.96, caisses => caisses : 2129610, clients => 152630, fournisseurs => 13579, dettes_m_l => 0, capital => 108436770.96','2012-04-17',11,'2012-04-17 10:05:04'),(2,'resultat => 5000, actif => 108455349.96, dettes => 13579, immobs => Immeubles : 100000000; Materiels : 5000000; Mobilier : 1000000, marchandises => 168109.96, caisses => caisses : 2134610, clients => 152630, fournisseurs => 13579, dettes_m_l => 0, capital => 108436770.96','2012-04-17',11,'2012-04-17 10:11:20');
/*!40000 ALTER TABLE `bilans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bons`
--

DROP TABLE IF EXISTS `bons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bons`
--

LOCK TABLES `bons` WRITE;
/*!40000 ALTER TABLE `bons` DISABLE KEYS */;
INSERT INTO `bons` VALUES (1,4,'1','ENTREE','Approvisionement','2012-03-24',11,'2012-03-24 21:44:24','2012-03-24 21:44:24'),(2,6,'2','ENTREE','Approvisionement','2012-04-07',11,'2012-04-07 19:49:43','2012-04-07 19:49:44'),(3,7,'3','ENTREE','Approvisionement','2012-04-05',11,'2012-04-07 19:57:22','2012-04-07 19:57:22'),(4,6,'4','ENTREE','Approvisionement','2012-04-04',11,'2012-04-07 20:10:53','2012-04-07 20:10:53'),(5,8,'5','ENTREE','Approvisionement','2012-04-02',11,'2012-04-07 20:24:01','2012-04-07 20:24:01'),(6,8,'6','ENTREE','Approvisionement','2012-04-13',11,'2012-04-13 08:16:01','2012-04-13 08:16:01'),(7,12,'7','ENTREE','Approvisionement','2012-04-13',11,'2012-04-13 08:41:29','2012-04-13 08:41:29'),(8,13,'675544','ENTREE','Approvisionement','2012-04-13',35,'2012-04-13 10:16:28','2012-04-13 10:16:28'),(10,13,'10','ENTREE','Approvisionement','2012-04-14',11,'2012-04-14 12:33:16','2012-04-14 12:33:16');
/*!40000 ALTER TABLE `bons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caisse_interdites`
--

DROP TABLE IF EXISTS `caisse_interdites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caisse_interdites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `personnel_id` bigint(20) NOT NULL,
  `caiss_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisse_interdites`
--

LOCK TABLES `caisse_interdites` WRITE;
/*!40000 ALTER TABLE `caisse_interdites` DISABLE KEYS */;
/*!40000 ALTER TABLE `caisse_interdites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caisse_operations`
--

DROP TABLE IF EXISTS `caisse_operations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caisse_operations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `journal_id` bigint(20) DEFAULT NULL,
  `operation` varchar(50) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `caiss_id` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisse_operations`
--

LOCK TABLES `caisse_operations` WRITE;
/*!40000 ALTER TABLE `caisse_operations` DISABLE KEYS */;
INSERT INTO `caisse_operations` VALUES (1,8,'ajout',1,10000,'BIF',2,'iii','2012-03-26',30,'2012-03-26 18:37:53','2012-03-26 18:37:53'),(2,NULL,'ajout',1,1000,'BIF',2,'','2012-04-07',11,'2012-04-07 22:29:44','2012-04-07 22:29:44'),(3,NULL,'retrait',2,500,'BIF',2,'removal','2012-04-07',11,'2012-04-07 22:59:22','2012-04-07 22:59:22'),(5,NULL,'retrait',4,5000,'BIF',3,'achat unitÃ© leo','2012-04-13',11,'2012-04-13 09:23:45','2012-04-13 09:23:45'),(6,NULL,'retrait',3,3000,'BIF',3,'paiement taxi pour le mÃ©canicien','2012-04-13',11,'2012-04-13 09:24:47','2012-04-13 09:24:47'),(7,NULL,'retrait',2,6000,'BIF',3,'rÃ©paration voiture','2012-04-13',11,'2012-04-13 09:26:34','2012-04-13 09:26:34'),(8,NULL,'retrait',4,10000,'BIF',3,'achat unite smart','2012-04-13',35,'2012-04-13 10:20:52','2012-04-13 10:20:52'),(9,NULL,'retrait',6,10000,'BIF',3,'achat pommme de terre','2012-04-17',11,'2012-04-17 09:57:30','2012-04-17 09:57:30'),(10,NULL,'ajout',1,10000,'BIF',3,'vente service','2012-04-17',11,'2012-04-17 10:10:36','2012-04-17 10:10:36'),(11,NULL,'retrait',6,5000,'BIF',3,'achat oignons','2012-04-17',11,'2012-04-17 10:11:08','2012-04-17 10:11:08');
/*!40000 ALTER TABLE `caisse_operations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caisses`
--

DROP TABLE IF EXISTS `caisses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caisses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `actif` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisses`
--

LOCK TABLES `caisses` WRITE;
/*!40000 ALTER TABLE `caisses` DISABLE KEYS */;
INSERT INTO `caisses` VALUES (2,'caisse','bar',602420,'BIF','oui','',11,'2012-03-24 20:34:44','2012-03-24 20:34:44'),(3,'caisse','comptable',66000,'BIF','oui','C\'est la caisse du comptable',11,'2012-04-13 09:03:49','2012-04-13 09:03:49');
/*!40000 ALTER TABLE `caisses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `camions`
--

DROP TABLE IF EXISTS `camions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `camions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plaque` varchar(255) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `proprietaire_id` bigint(50) NOT NULL,
  `situation` varchar(255) NOT NULL,
  `observation` text NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camions`
--

LOCK TABLES `camions` WRITE;
/*!40000 ALTER TABLE `camions` DISABLE KEYS */;
/*!40000 ALTER TABLE `camions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carburants`
--

DROP TABLE IF EXISTS `carburants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carburants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `chauffeur_id` bigint(20) NOT NULL,
  `autre_beneficiaire` varchar(50) NOT NULL,
  `bon` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `unite` varchar(50) NOT NULL,
  `quantite` double unsigned NOT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carburants`
--

LOCK TABLES `carburants` WRITE;
/*!40000 ALTER TABLE `carburants` DISABLE KEYS */;
/*!40000 ALTER TABLE `carburants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chambres`
--

DROP TABLE IF EXISTS `chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chambres` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_chambre_id` bigint(20) NOT NULL,
  `etage_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `propre` varchar(50) NOT NULL,
  `disponible` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chambres`
--

LOCK TABLES `chambres` WRITE;
/*!40000 ALTER TABLE `chambres` DISABLE KEYS */;
INSERT INTO `chambres` VALUES (1,1,1,'101',NULL,'oui','oui','',11,'2012-03-30 09:46:52','2012-03-30 09:46:52'),(2,1,1,'102',22,'oui','oui','',11,'2012-03-30 09:47:03','2012-03-30 09:47:03'),(3,2,2,'201',NULL,'oui','oui','',11,'2012-03-30 09:47:13','2012-03-30 09:47:13'),(4,2,2,'202',202,'oui','oui','',11,'2012-03-30 09:47:22','2012-03-30 09:47:22'),(5,1,2,'206',206,'oui','oui','',11,'2012-04-05 19:20:28','2012-04-05 19:21:03'),(6,3,3,'501',501,'oui','oui','',11,'2012-04-09 12:46:06','2012-04-09 12:46:06');
/*!40000 ALTER TABLE `chambres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chauffeurs`
--

DROP TABLE IF EXISTS `chauffeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chauffeurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `camion_id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chauffeurs`
--

LOCK TABLES `chauffeurs` WRITE;
/*!40000 ALTER TABLE `chauffeurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `chauffeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cochauffeurs`
--

DROP TABLE IF EXISTS `cochauffeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cochauffeurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chauffeur_id` bigint(20) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `adresse` text,
  `tel` varchar(50) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cochauffeurs`
--

LOCK TABLES `cochauffeurs` WRITE;
/*!40000 ALTER TABLE `cochauffeurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cochauffeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commandes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commandes`
--

LOCK TABLES `commandes` WRITE;
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
INSERT INTO `commandes` VALUES (1,'1','2012-04-14',11,'2012-04-14 12:42:29','2012-04-14 12:42:29');
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comptes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `compte_num` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `famille` varchar(50) NOT NULL,
  `sous_famille` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `id_element` bigint(20) DEFAULT NULL,
  `date_operation` date NOT NULL,
  `libelle` text NOT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `monnaie` varchar(50) DEFAULT NULL,
  `date_cloture` date DEFAULT NULL,
  `personnel_id` bigint(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comptes`
--

LOCK TABLES `comptes` WRITE;
/*!40000 ALTER TABLE `comptes` DISABLE KEYS */;
INSERT INTO `comptes` VALUES (96,NULL,'actif','cpte_tier','clients','Tier',9,'2012-04-17','Vente Ã  credit Facture NÂ°139',10500,NULL,'BIF',NULL,30,'2012-04-17 11:39:44'),(95,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',NULL,10500,'BIF',NULL,30,'2012-04-17 11:39:44'),(93,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',NULL,0,'BIF',NULL,30,'2012-04-17 11:38:19'),(94,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',0,NULL,'BIF',NULL,30,'2012-04-17 11:38:19'),(91,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',NULL,0,'BIF',NULL,30,'2012-04-17 11:38:14'),(92,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',0,NULL,'BIF',NULL,30,'2012-04-17 11:38:14'),(90,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',0,NULL,'BIF',NULL,30,'2012-04-17 11:38:04'),(89,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°139',NULL,0,'BIF',NULL,30,'2012-04-17 11:38:04'),(88,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',0,NULL,'BIF',NULL,30,'2012-04-17 11:19:46'),(87,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',NULL,0,'BIF',NULL,30,'2012-04-17 11:19:46'),(86,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',0,NULL,'BIF',NULL,30,'2012-04-17 11:19:35'),(85,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',NULL,0,'BIF',NULL,30,'2012-04-17 11:19:35'),(84,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',0,NULL,'BIF',NULL,30,'2012-04-17 11:19:24'),(83,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',NULL,0,'BIF',NULL,30,'2012-04-17 11:19:24'),(82,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',0,NULL,'BIF',NULL,30,'2012-04-17 11:17:09'),(81,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',NULL,0,'BIF',NULL,30,'2012-04-17 11:17:09'),(80,NULL,'actif','cpte_financier','caisses','Caiss',3,'2012-04-17','Virement de la caisse : bar vers la caisse : comptable',5000,NULL,'BIF',NULL,11,'2012-04-17 10:39:27'),(79,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-17','Virement de la caisse : bar vers la caisse : comptable',NULL,5000,'BIF',NULL,11,'2012-04-17 10:39:27'),(78,NULL,'actif','cpte_charge',NULL,'Type',6,'2012-04-17','achat oignons',5000,NULL,'BIF',NULL,11,'2012-04-17 10:11:08'),(77,NULL,'actif','cpte_financier','caisses','Caiss',3,'2012-04-17','achat oignons',NULL,5000,'BIF',NULL,11,'2012-04-17 10:11:08'),(76,NULL,'passif','cpte_produit',NULL,'Type',1,'2012-04-17','vente service',NULL,10000,'BIF',NULL,11,'2012-04-17 10:10:36'),(75,NULL,'actif','cpte_financier','caisses','Caiss',3,'2012-04-17','vente service',10000,NULL,'BIF',NULL,11,'2012-04-17 10:10:36'),(74,10,'passif','fonds_dettes','capital',NULL,NULL,'2012-04-17','initialisation du compte',NULL,108436770.96,'BIF',NULL,11,'2012-04-17 10:05:04'),(73,NULL,'actif','cpte_tier','clients','Tier',1,'2012-04-17','Initialisation du compte',18500,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(72,NULL,'actif','cpte_tier','clients','Tier',2,'2012-04-17','Initialisation du compte',10500,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(71,NULL,'actif','cpte_tier','clients','Tier',3,'2012-04-17','Initialisation du compte',39000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(70,NULL,'actif','cpte_tier','clients','Tier',2,'2012-04-17','Initialisation du compte',480,NULL,'USD',NULL,11,'2012-04-17 09:58:46'),(69,NULL,'actif','cpte_tier','clients','Tier',1,'2012-04-17','Initialisation du compte',700,NULL,'USD',NULL,11,'2012-04-17 09:58:46'),(68,NULL,'actif','cpte_tier','clients','Tier',5,'2012-04-17','Initialisation du compte',18000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(67,NULL,'actif','cpte_tier','clients','Tier',4,'2012-04-17','Initialisation du compte',10000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(66,NULL,'passif','cpte_tier','fournisseurs','Tier',8,'2012-04-17','Initialisation du compte',NULL,6500,'BIF',NULL,11,'2012-04-17 09:58:46'),(65,NULL,'actif','cpte_tier','clients','Tier',9,'2012-04-17','Initialisation du compte',36700,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(64,NULL,'actif','cpte_tier','clients','Tier',9,'2012-04-17','Initialisation du compte',750,NULL,'USD',NULL,11,'2012-04-17 09:58:46'),(63,NULL,'passif','cpte_tier','fournisseurs','Tier',13,'2012-04-17','Initialisation du compte',NULL,7079,'BIF',NULL,11,'2012-04-17 09:58:46'),(62,NULL,'actif','cpte_tier','clients','Tier',10,'2012-04-17','Initialisation du compte',500,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(61,NULL,'actif','cpte_tier','clients','Tier',14,'2012-04-17','Initialisation du compte',17500,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(60,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-17','Initialisation du compte',573610,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(59,NULL,'actif','cpte_financier','caisses','Caiss',3,'2012-04-17','Initialisation du compte',1556000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(58,NULL,'actif','cpte_immob',NULL,'TypeImmobilisation',1,'2012-04-17','Initialisation du compte',100000000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(57,NULL,'actif','cpte_immob',NULL,'TypeImmobilisation',3,'2012-04-17','Initialisation du compte',5000000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(56,NULL,'actif','cpte_immob',NULL,'TypeImmobilisation',2,'2012-04-17','Initialisation du compte',1000000,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(55,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Initialisation du compte',168109.96,NULL,'BIF',NULL,11,'2012-04-17 09:58:46'),(97,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°138',NULL,18900,'BIF',NULL,30,'2012-04-17 11:40:37'),(98,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-17','Paiement Vente facture NÂ°138',18900,NULL,'BIF',NULL,30,'2012-04-17 11:40:37'),(99,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',NULL,0,'BIF',NULL,30,'2012-04-17 11:41:13'),(100,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',0,NULL,'BIF',NULL,30,'2012-04-17 11:41:13'),(101,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',NULL,0,'BIF',NULL,30,'2012-04-17 11:42:04'),(102,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',0,NULL,'BIF',NULL,30,'2012-04-17 11:42:04'),(103,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',NULL,0,'BIF',NULL,30,'2012-04-17 11:42:08'),(104,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',0,NULL,'BIF',NULL,30,'2012-04-17 11:42:08'),(105,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Annulation de la vente de marchandises facture NÂ°140',0,NULL,'BIF',NULL,30,'2012-04-17 11:42:23'),(106,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Annulation de la vente de marchandises facture NÂ°140',NULL,0,'BIF',NULL,30,'2012-04-17 11:42:23'),(107,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Annulation de la vente de marchandises facture NÂ°140',0,NULL,'BIF',NULL,30,'2012-04-17 11:42:46'),(108,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Annulation de la vente de marchandises facture NÂ°140',NULL,0,'BIF',NULL,30,'2012-04-17 11:42:46'),(109,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°140',NULL,3000,'BIF',NULL,36,'2012-04-17 11:59:26'),(110,NULL,'actif','cpte_tier','clients','Tier',15,'2012-04-17','Vente Ã  credit Facture NÂ°140',3000,NULL,'BIF',NULL,36,'2012-04-17 11:59:26'),(111,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°141',NULL,0,'BIF',NULL,30,'2012-04-17 12:02:40'),(112,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°141',0,NULL,'BIF',NULL,30,'2012-04-17 12:02:40'),(113,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°141',NULL,17000,'BIF',NULL,30,'2012-04-17 12:03:46'),(114,NULL,'actif','cpte_tier','clients','Tier',15,'2012-04-17','Vente Ã  credit Facture NÂ°141',5000,NULL,'BIF',NULL,30,'2012-04-17 12:03:46'),(115,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-17','Paiement Vente facture NÂ°141',12000,NULL,'BIF',NULL,30,'2012-04-17 12:03:46'),(116,NULL,'actif','cpte_tier','clients','Tier',15,'2012-04-17','Paiement de la facture  NÂ°140',NULL,3000,'BIF',NULL,30,'2012-04-17 12:06:53'),(117,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-17','Remboursement de la facture NÂ°140',3000,NULL,'BIF',NULL,30,'2012-04-17 12:06:53'),(118,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°142',NULL,1000,'BIF',NULL,30,'2012-04-17 12:11:17'),(119,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Vente de marchandises facture NÂ°142',1000,NULL,'BIF',NULL,30,'2012-04-17 12:11:17'),(120,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-17','Annulation de la vente de marchandises facture NÂ°142',1000,NULL,'BIF',NULL,30,'2012-04-17 12:12:15'),(121,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-17','Annulation de la vente de marchandises facture NÂ°142',NULL,1000,'BIF',NULL,30,'2012-04-17 12:12:15'),(122,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-03-24','Vente de marchandises facture NÂ°143',NULL,1000,'BIF',NULL,11,'2012-04-18 15:19:11'),(123,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-03-24','Vente de marchandises facture NÂ°143',1000,NULL,'BIF',NULL,11,'2012-04-18 15:19:11'),(124,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-03-24','Vente de marchandises facture NÂ°144',NULL,1000,'BIF',NULL,11,'2012-04-18 15:20:01'),(125,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-03-24','Vente de marchandises facture NÂ°144',1000,NULL,'BIF',NULL,11,'2012-04-18 15:20:01'),(126,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°145',NULL,1000,'BIF',NULL,30,'2012-04-18 15:20:44'),(127,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°145',1000,NULL,'BIF',NULL,30,'2012-04-18 15:20:44'),(128,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°146',NULL,1000,'BIF',NULL,30,'2012-04-18 15:21:25'),(129,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°146',1000,NULL,'BIF',NULL,30,'2012-04-18 15:21:25'),(130,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°147',NULL,1000,'BIF',NULL,30,'2012-04-18 15:22:08'),(131,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°147',1000,NULL,'BIF',NULL,30,'2012-04-18 15:22:08'),(132,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°148',NULL,1000,'BIF',NULL,30,'2012-04-18 15:30:23'),(133,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°148',1000,NULL,'BIF',NULL,30,'2012-04-18 15:30:23'),(134,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°149',NULL,1000,'BIF',NULL,30,'2012-04-18 15:49:53'),(135,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'2012-04-18','Vente de marchandises facture NÂ°149',1000,NULL,'BIF',NULL,30,'2012-04-18 15:49:53'),(136,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-18','Annulation du Paiement Vente facture NÂ°118',NULL,50,'USD',NULL,11,'2012-04-18 17:23:55'),(137,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'2012-04-18','Annulation de l\' HÃ©bergement facture NÂ°118',2000,NULL,'USD',NULL,11,'2012-04-18 17:23:55'),(138,NULL,'actif','cpte_tier','clients','Tier',9,'2012-04-18','Annulation Reservation Ã  credit Facture NÂ°118',NULL,1950,'USD',NULL,11,'2012-04-18 17:23:55'),(139,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'2012-04-18','Annulation de l\' HÃ©bergement facture NÂ°121',150,NULL,'BIF',NULL,11,'2012-04-18 17:24:13'),(140,NULL,'actif','cpte_tier','clients','Tier',10,'2012-04-18','Annulation Reservation Ã  credit Facture NÂ°121',NULL,150,'BIF',NULL,11,'2012-04-18 17:24:13'),(141,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'2012-04-18','Annulation de l\' HÃ©bergement facture NÂ°121',150,NULL,'BIF',NULL,11,'2012-04-18 17:24:28'),(142,NULL,'actif','cpte_tier','clients','Tier',10,'2012-04-18','Annulation Reservation Ã  credit Facture NÂ°121',NULL,150,'BIF',NULL,11,'2012-04-18 17:24:28'),(143,NULL,'actif','cpte_financier','caisses','Caiss',3,'2012-04-18','Annulation du Paiement Vente facture NÂ°117',NULL,1170,'USD',NULL,11,'2012-04-18 17:40:59'),(144,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'2012-04-18','Annulation de l\' HÃ©bergement facture NÂ°117',1170,NULL,'USD',NULL,11,'2012-04-18 17:40:59'),(145,NULL,'actif','cpte_financier','caisses','Caiss',2,'2012-04-18','Annulation du Paiement Vente facture NÂ°84',NULL,864,'USD',NULL,11,'2012-04-18 17:46:01'),(146,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'2012-04-18','Annulation de l\' HÃ©bergement facture NÂ°84',900,NULL,'USD',NULL,11,'2012-04-18 17:46:01'),(147,NULL,'actif','cpte_tier','clients','Tier',5,'2012-04-18','Annulation Reservation Ã  credit Facture NÂ°84',NULL,36,'USD',NULL,11,'2012-04-18 17:46:01'),(148,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'2012-04-18','Annulation de l\' HÃ©bergement facture NÂ°64',2925,NULL,'USD',NULL,11,'2012-04-18 17:46:17'),(149,NULL,'actif','cpte_tier','clients','Tier',1,'2012-04-18','Annulation Reservation Ã  credit Facture NÂ°64',NULL,2925,'USD',NULL,11,'2012-04-18 17:46:17');
/*!40000 ALTER TABLE `comptes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES (22,'echeance','2',11),(21,'company_name','a',11),(5,'stock_id','1',19),(6,'logo','2012-04-16-184850logo.jpg',11),(7,'expiration','2',11),(8,'transport','3',11),(9,'command','mysqldump',11),(10,'emprunt','oui',0),(11,'pret','oui',19),(12,'min','10',11),(13,'dette','oui',19),(14,'creance','oui',19),(15,'tva','18',11),(16,'section_id','2',19),(17,'groupe_id','4',19),(18,'boissons_stock','1',19),(19,'boissons_section','1',11),(20,'company_address','jjjj',11),(23,'message','',11),(24,'serveurs','1',11),(25,'plats_section','5',11),(26,'default_unit','4',11),(27,'caissiers','2',11),(28,'resto_stock','1',11),(29,'resto_caisse','2',11),(30,'company_address1','AVENUE DU PEUPLE MURUNDI',11),(31,'company_address2','BUJUMBURA',11),(32,'company_tel','+257 22 24 80 16',11),(33,'company_nif','4000046344',11),(34,'company_compte','IBB 701619650167',11),(35,'address1','AVENUE DU PEUPLE MURUNDI',11),(36,'address2','',11),(37,'tel','+25722248016',11),(38,'nif','4000046344',11),(39,'compte','IBB 701619650167',11),(42,'compte1','IBB (FBU) 7862626627',11),(40,'email','info@starhotel.bi',11),(41,'bp','5161',11),(43,'compte2','IBB (DOLLAR) 766256262',11),(44,'compte3','',11),(45,'hebergement','77',11),(46,'marchandises','30',11),(47,'cout_stocks_vendus','60',11),(48,'stocks_vendus','70',11),(49,'capital','10',11),(50,'ventes','70',11);
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containeurs`
--

DROP TABLE IF EXISTS `containeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `containeurs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `numero` mediumint(9) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containeurs`
--

LOCK TABLES `containeurs` WRITE;
/*!40000 ALTER TABLE `containeurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `containeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversions`
--

DROP TABLE IF EXISTS `conversions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `premier_unite_id` bigint(20) NOT NULL,
  `conversion` double NOT NULL,
  `deuxieme_unite_id` bigint(20) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversions`
--

LOCK TABLES `conversions` WRITE;
/*!40000 ALTER TABLE `conversions` DISABLE KEYS */;
INSERT INTO `conversions` VALUES (1,2,12,4,0,'2011-10-11 15:39:34','2011-10-11 15:39:34'),(2,1,1000,3,0,'2011-10-11 15:39:49','2011-10-11 15:39:49'),(3,5,100,3,0,'2011-10-11 15:40:17','2011-10-11 15:40:17'),(4,6,6,4,0,'2011-10-11 15:42:46','2011-10-11 15:42:46');
/*!40000 ALTER TABLE `conversions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(50) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `produit_id` bigint(20) DEFAULT NULL,
  `quantite` double NOT NULL,
  `PA` double NOT NULL,
  `date` date NOT NULL,
  `batch` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `details`
--

LOCK TABLES `details` WRITE;
/*!40000 ALTER TABLE `details` DISABLE KEYS */;
INSERT INTO `details` VALUES (1,'Recette',87,17,1,1000,'2012-03-30',NULL),(2,'Recette',88,17,1,1000,'2012-03-30',NULL),(3,'Recette',89,17,1,1000,'2012-03-30',NULL),(4,'Recette',90,17,1,1000,'2012-03-30',NULL),(5,'Recette',91,17,1,1000,'2012-03-30',NULL),(6,'Recette',94,17,1,1000,'2012-03-30',NULL),(7,'Recette',95,17,1,1000,'2012-03-30',NULL),(8,'Recette',96,17,1,1000,'2012-03-30',NULL),(12,'Recette',100,17,1,1000,'2012-03-30',NULL),(11,'Recette',99,17,1,1000,'2012-03-30',NULL),(13,'Recette',133,28165,1,900,'2012-03-26',NULL),(14,'Recette',141,17,1,1000,'2012-04-08',NULL),(15,'Recette',142,17,1,1000,'2012-04-08',NULL),(16,'Recette',143,17,1,1000,'2012-04-08',NULL),(17,'Recette',144,17,1,1000,'2012-04-08',NULL),(18,'Recette',145,17,1,1000,'2012-04-08',NULL),(19,'Recette',146,17,1,1000,'2012-04-08',NULL),(20,'Recette',147,17,1,1000,'2012-04-08',NULL),(21,'Recette',148,17,1,1000,'2012-04-08',NULL),(22,'Recette',149,17,1,1000,'2012-04-08',NULL),(23,'Recette',150,17,1,1000,'2012-04-08',NULL),(24,'Recette',151,17,1,1000,'2012-04-08',NULL),(25,'Recette',152,17,1,1000,'2012-04-08',NULL),(34,'Recette',159,17,1,1000,'2012-04-08',NULL),(33,'Recette',158,17,1,1000,'2012-04-08',NULL),(30,'Recette',155,17,1,1000,'2012-04-08',NULL),(36,'Recette',161,17,1,1000,'2012-04-08',NULL),(37,'Recette',162,17,1,1000,'2012-04-08',NULL),(41,'Recette',173,17,1,1000,'2012-04-08',NULL),(42,'Recette',179,28165,2,900,'2012-03-26',NULL),(43,'Recette',183,28165,3,900,'2012-03-26',NULL),(45,'Recette',198,17,1,1000,'2012-04-08',NULL),(46,'Recette',199,17,1,1000,'2012-04-08',NULL),(47,'Recette',200,17,1,1000,'2012-04-08',NULL),(48,'Recette',201,17,1,1000,'2012-04-08',NULL),(49,'Recette',202,17,1,1000,'2012-04-08',NULL),(50,'Recette',203,17,1,1000,'2012-04-08',NULL),(51,'Recette',204,17,1,1000,'2012-04-08',NULL);
/*!40000 ALTER TABLE `details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dettes`
--

DROP TABLE IF EXISTS `dettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dettes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `max` double DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dettes`
--

LOCK TABLES `dettes` WRITE;
/*!40000 ALTER TABLE `dettes` DISABLE KEYS */;
INSERT INTO `dettes` VALUES (1,1,'client',18500,'BIF',NULL,NULL,30,'2012-03-24 20:46:15','2012-03-24 20:46:15'),(2,2,'client',10500,'BIF',NULL,NULL,11,'2012-03-24 21:02:52','2012-03-24 21:02:52'),(3,3,'client',39000,'BIF',NULL,NULL,11,'2012-03-24 20:37:21','2012-03-24 20:37:21'),(4,2,'client',480,'USD',NULL,NULL,11,'2012-03-30 09:48:01','2012-03-30 09:48:01'),(5,1,'client',0,'USD',NULL,NULL,11,'2012-03-31 10:45:38','2012-03-31 10:45:38'),(6,5,'client',18000,'BIF',NULL,NULL,11,'2012-04-05 19:57:35','2012-04-05 19:57:35'),(7,4,'client',10000,'BIF',NULL,NULL,11,'2012-04-07 21:30:20','2012-04-07 21:30:20'),(8,8,'fournisseur',6500,'BIF',NULL,NULL,11,'2012-04-07 21:33:21','2012-04-07 21:33:21'),(10,9,'client',47200,'BIF',NULL,NULL,30,'2012-04-09 11:21:54','2012-04-09 11:21:54'),(11,5,'client',0,'USD',NULL,NULL,11,'2012-04-09 12:12:19','2012-04-09 12:12:19'),(12,9,'client',0,'USD',NULL,NULL,11,'2012-04-09 13:41:15','2012-04-09 13:41:15'),(13,12,'fournisseur',0,'BIF',NULL,NULL,11,'2012-04-13 08:47:57','2012-04-13 08:47:57'),(14,13,'fournisseur',7079,'BIF',NULL,NULL,11,'2012-04-13 10:18:35','2012-04-13 10:18:35'),(15,10,'client',200,'BIF',NULL,NULL,11,'2012-04-14 16:51:12','2012-04-14 16:51:12'),(16,14,'client',17500,'BIF',NULL,NULL,30,'2012-04-17 09:23:33','2012-04-17 09:23:33'),(17,15,'client',5000,'BIF',10000,'0000-00-00',30,'2012-04-17 11:59:26','2012-04-17 12:01:23');
/*!40000 ALTER TABLE `dettes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dotations`
--

DROP TABLE IF EXISTS `dotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dotations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bon_id` bigint(20) DEFAULT NULL,
  `chambre_id` bigint(20) NOT NULL,
  `produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `unite_id` bigint(20) DEFAULT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dotations`
--

LOCK TABLES `dotations` WRITE;
/*!40000 ALTER TABLE `dotations` DISABLE KEYS */;
/*!40000 ALTER TABLE `dotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entretien_chambres`
--

DROP TABLE IF EXISTS `entretien_chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entretien_chambres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `chambre_id` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entretien_chambres`
--

LOCK TABLES `entretien_chambres` WRITE;
/*!40000 ALTER TABLE `entretien_chambres` DISABLE KEYS */;
/*!40000 ALTER TABLE `entretien_chambres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entretiens`
--

DROP TABLE IF EXISTS `entretiens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entretiens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paiement` varchar(50) NOT NULL,
  `bon` varchar(50) NOT NULL,
  `monaie` varchar(50) NOT NULL,
  `chauffeur_id` bigint(20) unsigned NOT NULL,
  `checked_out_repare` text NOT NULL,
  `montant` double unsigned NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entretiens`
--

LOCK TABLES `entretiens` WRITE;
/*!40000 ALTER TABLE `entretiens` DISABLE KEYS */;
/*!40000 ALTER TABLE `entretiens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etages`
--

DROP TABLE IF EXISTS `etages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etages`
--

LOCK TABLES `etages` WRITE;
/*!40000 ALTER TABLE `etages` DISABLE KEYS */;
INSERT INTO `etages` VALUES (1,'1',11,'2012-03-30 09:46:34','2012-03-30 09:46:34'),(2,'2',11,'2012-03-30 09:46:39','2012-03-30 09:46:39'),(3,'3',11,'2012-04-09 12:42:23','2012-04-09 12:43:05');
/*!40000 ALTER TABLE `etages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factures`
--

DROP TABLE IF EXISTS `factures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `journal_id` bigint(20) DEFAULT NULL,
  `tier_id` bigint(20) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `operation` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `montant` double DEFAULT NULL,
  `reste` double DEFAULT NULL,
  `tva` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `etat_paiement` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `echeance` date DEFAULT NULL,
  `classee` tinyint(1) NOT NULL,
  `printed` tinyint(1) DEFAULT NULL,
  `table` varchar(50) DEFAULT NULL,
  `observation` text,
  `date_emission` date DEFAULT NULL,
  `serveur_id` int(11) DEFAULT NULL,
  `bon` varchar(100) DEFAULT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factures`
--

LOCK TABLES `factures` WRITE;
/*!40000 ALTER TABLE `factures` DISABLE KEYS */;
INSERT INTO `factures` VALUES (1,1,NULL,'1','Recette','envoyee',8000,8000,0,'BIF','canceled','2012-03-24',NULL,1,1,'1','refus',NULL,32,NULL,30,'2012-03-24 20:20:03','2012-03-24 20:37:50'),(2,1,NULL,'2','Recette','envoyee',3000,3000,0,'BIF','cloturer','2012-03-24',NULL,0,1,'2','',NULL,31,NULL,11,'2012-03-24 20:27:15','2012-04-06 21:42:29'),(3,1,1,'3','Recette','envoyee',3500,3000,534,'BIF','avance','2012-03-24','2012-04-07',1,NULL,'2','',NULL,31,NULL,30,'2012-03-24 20:28:08','2012-03-24 20:50:16'),(4,1,0,'4','Recette','envoyee',3500,0,534,'BIF','payee','2012-03-24','2012-04-07',1,1,'2','',NULL,31,NULL,30,'2012-03-24 20:28:17','2012-03-24 20:41:06'),(5,2,NULL,'5','Recette','envoyee',3000,3000,0,'BIF','cloturer','2012-03-24',NULL,0,1,'2','',NULL,32,NULL,29,'2012-03-24 20:53:14','2012-03-24 20:53:35'),(6,2,2,'6','Recette','envoyee',9000,9000,1373,'BIF','credit','2012-03-24','2012-04-07',1,NULL,'2','',NULL,31,NULL,29,'2012-03-24 20:55:17','2012-03-24 21:02:52'),(7,2,2,'7','Recette','envoyee',3000,3000,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'2','',NULL,31,NULL,29,'2012-03-24 21:00:14','2012-03-24 21:00:14'),(8,2,2,'8','Recette','envoyee',1000,1000,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'2','',NULL,31,NULL,29,'2012-03-24 21:00:26','2012-03-24 21:00:26'),(9,2,0,'9','Recette','envoyee',10000,0,1526,'BIF','payee','2012-03-24','2012-04-08',1,NULL,'5','',NULL,31,NULL,11,'2012-03-24 21:10:32','2012-03-25 16:55:35'),(10,2,0,'10','Recette','envoyee',20000,0,3051,'BIF','payee','2012-03-24','2012-04-09',1,NULL,'5','',NULL,31,NULL,29,'2012-03-24 21:11:10','2012-03-26 10:16:07'),(11,2,3,'11','Recette','envoyee',3000,3000,458,'BIF','credit','2012-03-24','2012-04-07',1,NULL,'5','',NULL,31,NULL,11,'2012-03-24 21:11:32','2012-03-24 20:37:57'),(12,2,3,'12','Recette','envoyee',3000,3000,458,'BIF','credit','2012-03-24','2012-04-07',1,NULL,'3','',NULL,32,NULL,11,'2012-03-24 21:12:15','2012-03-24 20:37:21'),(13,2,0,'13','Recette','envoyee',3000,0,458,'BIF','payee','2012-03-24','2012-04-07',1,NULL,'3','',NULL,31,NULL,11,'2012-03-24 21:13:14','2012-03-24 20:35:48'),(14,3,NULL,'14','Recette','envoyee',5000,5000,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','',NULL,31,NULL,11,'2012-03-24 20:42:47','2012-03-24 20:53:24'),(15,3,0,'15','Recette','envoyee',70,0,11,'BIF','payee','2012-03-24','2012-04-08',1,NULL,'0','',NULL,32,NULL,11,'2012-03-25 16:22:38','2012-03-25 20:06:39'),(16,3,NULL,'16','Recette','envoyee',0,0,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0','',NULL,31,NULL,11,'2012-03-25 16:24:24','2012-03-25 16:24:42'),(17,3,NULL,'17','Recette','envoyee',25000,25000,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0','',NULL,31,NULL,11,'2012-03-25 16:24:52','2012-03-25 16:25:04'),(18,3,NULL,'18','Recette','envoyee',-5000,-5000,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0','',NULL,31,NULL,11,'2012-03-25 16:28:12','2012-03-25 16:28:33'),(19,3,NULL,'19','Recette','envoyee',-1000,-1000,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0','',NULL,31,NULL,11,'2012-03-25 16:34:46','2012-03-25 16:34:59'),(20,3,NULL,'20','Recette','envoyee',18000,18000,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','hello boss',NULL,32,NULL,11,'2012-03-25 16:38:50','2012-03-25 19:49:34'),(21,3,0,'21','Recette','envoyee',2500,0,381,'BIF','payee','2012-03-24','2012-04-08',1,NULL,'0','',NULL,31,NULL,11,'2012-03-25 16:53:14','2012-03-25 16:55:06'),(22,3,0,'22','Recette','envoyee',2500,0,381,'BIF','payee','2012-03-24','2012-04-08',1,NULL,'0','',NULL,31,NULL,11,'2012-03-25 16:54:38','2012-03-25 16:54:44'),(23,3,0,'23','Recette','envoyee',3200,0,488,'BIF','payee','2012-03-24','2012-04-09',1,NULL,'18','',NULL,32,NULL,29,'2012-03-25 20:36:40','2012-03-26 10:15:53'),(24,2,0,'24','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-24','2012-04-09',1,NULL,'0','',NULL,32,NULL,29,'2012-03-26 10:14:41','2012-03-26 10:14:47'),(25,4,0,'25','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 13:17:02','2012-03-26 14:23:26'),(26,4,0,'26','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 13:18:04','2012-03-26 14:23:21'),(27,4,0,'27','Recette','envoyee',2500,0,381,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 13:20:10','2012-03-26 14:23:16'),(28,2,NULL,'28','Recette','envoyee',1200,1200,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,29,'2012-03-26 13:21:08','2012-03-26 13:21:08'),(29,2,NULL,'29','Recette','envoyee',1200,1200,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,29,'2012-03-26 13:22:38','2012-03-26 13:22:38'),(30,2,NULL,'30','Recette','envoyee',1200,1200,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,29,'2012-03-26 13:22:49','2012-03-26 13:22:49'),(31,2,NULL,'31','Recette','envoyee',1200,1200,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','yyye',NULL,32,NULL,29,'2012-03-26 13:22:57','2012-03-26 13:23:04'),(32,2,NULL,'32','Recette','envoyee',1200,1200,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,32,NULL,29,'2012-03-26 13:23:12','2012-03-26 13:23:12'),(33,2,0,'33','Recette','envoyee',2000,0,305,'BIF','payee','2012-03-24','2012-04-09',1,NULL,'0','',NULL,31,NULL,29,'2012-03-26 14:45:02','2012-03-26 14:45:11'),(34,5,0,'34','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 14:45:45','2012-03-26 14:45:55'),(35,3,NULL,'35','Recette','envoyee',2500,2500,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','yyyy',NULL,32,NULL,11,'2012-03-26 14:48:26','2012-03-26 14:48:52'),(36,3,NULL,'36','Recette','envoyee',2500,2500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,32,NULL,11,'2012-03-26 14:48:59','2012-03-26 14:48:59'),(37,2,0,'37','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-24','2012-04-09',1,NULL,'0','',NULL,31,NULL,29,'2012-03-26 17:47:26','2012-03-26 17:47:37'),(38,6,0,'38','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 17:47:57','2012-03-26 17:48:06'),(39,6,0,'39','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,32,NULL,30,'2012-03-26 17:49:55','2012-03-26 17:50:02'),(40,7,0,'40','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-26','2012-04-09',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 18:05:30','2012-03-26 18:05:35'),(41,2,NULL,'41','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,29,'2012-03-26 18:34:39','2012-03-26 18:34:39'),(42,8,0,'42','Recette','envoyee',47200,0,7200,'BIF','payee','2012-03-26','2012-04-10',1,NULL,'0','',NULL,31,NULL,30,'2012-03-26 18:34:59','2012-03-27 11:22:30'),(43,8,0,'43','Recette','envoyee',142800,0,21783,'BIF','payee','2012-03-26','2012-04-10',1,NULL,'boss','',NULL,31,NULL,30,'2012-03-27 07:33:03','2012-03-27 11:22:24'),(44,3,NULL,'44','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,11,'2012-03-27 09:28:18','2012-03-27 09:28:18'),(45,9,0,'45','Recette','envoyee',6000,0,915,'BIF','payee','2012-03-27','2012-04-11',1,NULL,'0','',NULL,31,NULL,30,'2012-03-27 16:48:48','2012-03-28 18:02:08'),(46,9,0,'46','Recette','envoyee',34000,0,5187,'BIF','payee','2012-03-27','2012-04-11',1,NULL,'3','',NULL,32,NULL,30,'2012-03-27 16:50:02','2012-03-28 18:02:04'),(47,9,0,'47','Recette','envoyee',10000,0,1526,'BIF','payee','2012-03-27','2012-04-11',1,NULL,'0','',NULL,32,NULL,30,'2012-03-28 18:02:17','2012-03-28 18:02:27'),(48,10,0,'48','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-28','2012-04-11',1,NULL,'0','',NULL,31,NULL,30,'2012-03-28 18:12:35','2012-03-28 18:12:40'),(49,11,0,'49','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-28','2012-04-11',1,NULL,'0','',NULL,32,NULL,30,'2012-03-28 18:14:25','2012-03-28 18:14:34'),(50,12,0,'50','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-28','2012-04-11',1,NULL,'0','',NULL,31,NULL,30,'2012-03-28 18:19:49','2012-03-28 18:20:02'),(51,13,2,'51','Recette','envoyee',10000,0,1526,'BIF','payee','2012-03-28','2012-04-11',1,NULL,'0','',NULL,32,NULL,30,'2012-03-28 18:25:52','2012-04-02 13:15:34'),(52,13,0,'52','Recette','envoyee',10000,0,1526,'BIF','payee','2012-03-28','2012-04-13',1,NULL,'0','',NULL,32,NULL,30,'2012-03-28 18:26:59','2012-03-30 22:55:18'),(53,NULL,2,'53','Reservation ','envoyee',480,480,73,'USD','credit','2012-03-30','2012-04-13',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-03-30 09:48:01','2012-03-30 09:48:01'),(54,13,0,'54','Recette','envoyee',1200,0,183,'BIF','payee','2012-03-28','2012-04-13',1,NULL,'0','',NULL,31,NULL,30,'2012-03-30 22:50:16','2012-03-30 22:50:23'),(55,14,0,'55','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-30','2012-04-13',1,NULL,'0','',NULL,32,NULL,30,'2012-03-30 22:56:16','2012-03-30 22:56:30'),(56,14,0,'56','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-30','2012-04-14',1,NULL,'0','',NULL,31,NULL,30,'2012-03-30 22:58:55','2012-03-31 11:34:20'),(57,14,0,'57','Recette','envoyee',10500,0,1602,'BIF','payee','2012-03-30','2012-04-14',1,NULL,'0','',NULL,31,NULL,30,'2012-03-30 23:31:59','2012-03-31 00:10:47'),(58,14,0,'58','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-30','2012-04-13',1,NULL,'0','',NULL,31,NULL,30,'2012-03-30 23:36:21','2012-03-30 23:59:07'),(59,14,0,'59','Recette','envoyee',4500,4500,687,'BIF','credit','2012-03-30','2012-04-14',1,1,'0','',NULL,31,NULL,11,'2012-03-30 23:36:34','2012-04-02 20:00:41'),(60,14,NULL,'60','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-03-30',NULL,1,NULL,'0','yy',NULL,31,NULL,30,'2012-03-30 23:48:38','2012-03-30 23:49:46'),(61,14,NULL,'61','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-03-30',NULL,1,NULL,'0','yyy',NULL,31,NULL,30,'2012-03-30 23:48:57','2012-03-30 23:49:57'),(62,14,0,'62','Recette','envoyee',1500,0,229,'BIF','canceled','2012-03-30','2012-04-13',1,NULL,'0','',NULL,31,NULL,11,'2012-03-30 23:50:04','2012-04-02 19:23:40'),(63,14,0,'63','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-30','2012-04-13',1,NULL,'0','',NULL,31,NULL,30,'2012-03-30 23:50:15','2012-03-30 23:51:26'),(64,NULL,1,'64','Reservation ','envoyee',2925,2925,446,'USD','canceled','2012-03-28','2012-04-11',1,NULL,NULL,'','2012-04-25',NULL,NULL,11,'2012-03-31 10:45:38','2012-04-18 17:46:17'),(65,14,1,'65','Recette','envoyee',3200,3200,488,'BIF','credit','2012-03-30','2012-04-14',1,NULL,'0','',NULL,31,NULL,30,'2012-03-31 11:05:57','2012-03-31 11:07:55'),(66,NULL,3,'66','Service rendu','envoyee',30000,30000,4576,'BIF','canceled','2012-03-31','2012-04-14',1,NULL,NULL,'',NULL,NULL,NULL,11,'2012-03-31 11:12:56','2012-04-02 19:59:16'),(67,15,0,'67','Recette','envoyee',5000,0,763,'BIF','payee','2012-03-31','2012-04-17',1,NULL,'0','',NULL,32,NULL,30,'2012-03-31 11:39:32','2012-04-03 18:35:49'),(68,NULL,0,'68','Recette','envoyee',1500,0,229,'BIF','canceled','2012-03-31','2012-04-14',1,NULL,'0','',NULL,33,NULL,11,'2012-03-31 11:40:02','2012-04-02 19:25:31'),(69,15,0,'69','Recette','envoyee',1200,0,183,'BIF','canceled','2012-03-31','2012-04-14',1,NULL,'0','',NULL,33,NULL,30,'2012-03-31 11:40:36','2012-04-02 19:12:53'),(70,15,2,'70','Recette','envoyee',30700,0,4683,'BIF','canceled','2012-03-31','2012-04-16',1,NULL,'0','',NULL,33,NULL,11,'2012-03-31 11:41:40','2012-04-02 19:11:52'),(71,15,0,'71','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-31','2012-04-16',1,NULL,'0','',NULL,31,NULL,30,'2012-04-02 13:14:50','2012-04-02 13:15:51'),(72,16,NULL,'72','Recette','envoyee',3000,3000,0,'BIF','canceled','2012-04-03',NULL,1,NULL,'0','yy',NULL,31,NULL,30,'2012-04-03 18:36:17','2012-04-03 18:37:24'),(73,16,0,'73','Recette','envoyee',13200,0,2013,'BIF','payee','2012-04-03','2012-04-19',1,NULL,'0','',NULL,32,NULL,30,'2012-04-03 18:38:38','2012-04-05 18:54:07'),(74,3,NULL,'74','Recette','envoyee',18000,18000,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,11,'2012-04-03 22:13:08','2012-04-03 22:13:15'),(75,16,2,'75','Recette','envoyee',8000,0,1220,'BIF','avance','2012-04-03','2012-04-19',1,NULL,'0','',NULL,31,NULL,30,'2012-04-03 22:20:13','2012-04-05 18:54:20'),(76,16,NULL,'76','Recette','envoyee',14000,14000,0,'BIF','canceled','2012-04-03',NULL,1,NULL,'0','ttt',NULL,32,NULL,30,'2012-04-03 22:22:30','2012-04-03 22:37:51'),(77,16,NULL,'77','Recette','envoyee',6000,6000,0,'BIF','canceled','2012-04-03',NULL,1,NULL,'0','erreur',NULL,31,NULL,30,'2012-04-03 22:38:07','2012-04-03 23:21:26'),(78,16,0,'78','Recette','envoyee',4000,0,610,'BIF','payee','2012-04-03','2012-04-19',1,NULL,'0','',NULL,31,NULL,30,'2012-04-03 23:21:36','2012-04-05 18:54:01'),(79,16,0,'79','Recette','envoyee',1200,0,183,'BIF','payee','2012-04-03','2012-04-19',1,NULL,'0','',NULL,31,NULL,30,'2012-04-03 23:22:32','2012-04-05 18:53:58'),(80,16,2,'80','Recette','envoyee',0,0,0,'BIF','avance','2012-04-03','2012-04-19',1,NULL,'0','',NULL,31,NULL,30,'2012-04-03 23:28:14','2012-04-05 18:53:42'),(81,16,0,'81','Recette','envoyee',2700,0,412,'BIF','payee','2012-04-03','2012-04-19',1,NULL,'0','',NULL,32,NULL,30,'2012-04-03 23:31:26','2012-04-05 18:53:26'),(82,3,0,'82','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-19',1,NULL,'0','',NULL,32,NULL,11,'2012-04-05 16:53:07','2012-04-05 16:53:41'),(83,16,0,'83','Recette','envoyee',2000,0,305,'BIF','payee','2012-04-03','2012-04-19',1,NULL,'0','',NULL,31,NULL,30,'2012-04-05 18:53:08','2012-04-05 18:53:15'),(84,NULL,5,'84','Reservation ','envoyee',900,36,137,'USD','canceled','2012-04-01','2012-04-01',1,NULL,NULL,'',NULL,NULL,NULL,11,'2012-04-05 19:40:31','2012-04-18 17:46:01'),(85,17,5,'85','Recette','envoyee',18000,0,2746,'BIF','payee','2012-04-05','2012-04-19',1,NULL,'8','A,use ',NULL,32,NULL,30,'2012-04-05 19:51:54','2012-04-05 19:55:57'),(86,17,5,'86','Recette','envoyee',10000,10000,1526,'BIF','credit','2012-04-05','2012-04-19',1,NULL,'8','',NULL,32,NULL,30,'2012-04-05 19:56:28','2012-04-05 19:57:35'),(87,17,5,'87','Recette','envoyee',6000,6000,915,'BIF','credit','2012-04-05','2012-04-19',1,NULL,'0','',NULL,31,NULL,30,'2012-04-05 20:07:50','2012-04-05 20:08:05'),(88,NULL,5,'88','Service rendu','envoyee',1000,1000,152,'BIF','credit','2012-04-07','2012-04-21',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-04-07 21:19:35','2012-04-07 21:19:35'),(89,NULL,4,'89','Service rendu','envoyee',10000,10000,1526,'BIF','credit','2012-04-07','2012-04-21',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-04-07 21:30:20','2012-04-07 21:30:20'),(90,NULL,8,'90','Service recu','recu',5000,5000,763,'BIF','credit','2012-04-07','2012-04-21',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-04-07 21:33:21','2012-04-07 21:33:21'),(91,17,0,'91','Recette','envoyee',1200,0,183,'BIF','payee','2012-04-05','2012-04-22',1,NULL,'0','',NULL,31,NULL,30,'2012-04-08 22:21:30','2012-04-08 22:21:38'),(92,3,NULL,'92','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,32,NULL,11,'2012-04-08 22:23:55','2012-04-08 22:23:55'),(93,3,NULL,'93','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,32,NULL,11,'2012-04-08 22:57:32','2012-04-08 22:57:32'),(94,3,NULL,'94','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,11,'2012-04-08 22:57:55','2012-04-08 22:57:55'),(95,3,NULL,'95','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,31,NULL,11,'2012-04-08 22:58:47','2012-04-08 22:58:47'),(96,3,NULL,'96','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'0',NULL,NULL,32,NULL,11,'2012-04-08 23:01:01','2012-04-08 23:01:01'),(97,3,2,'97','Recette','envoyee',1500,1500,229,'BIF','credit','2012-03-24','2012-04-23',1,NULL,'0','',NULL,32,NULL,11,'2012-04-09 01:06:13','2012-04-09 01:06:28'),(98,3,2,'98','Recette','envoyee',1500,1500,229,'BIF','credit','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 01:08:39','2012-04-09 01:08:50'),(99,3,0,'99','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 01:10:08','2012-04-09 01:10:13'),(100,3,0,'100','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 01:11:14','2012-04-09 01:11:21'),(101,3,0,'101','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-23',1,NULL,'0','',NULL,32,NULL,11,'2012-04-09 01:12:52','2012-04-09 01:12:59'),(102,3,0,'102','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 01:14:37','2012-04-09 01:14:41'),(103,3,2,'103','Recette','envoyee',1500,1500,229,'BIF','credit','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 01:16:33','2012-04-09 01:16:45'),(104,3,NULL,'104','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','test',NULL,31,NULL,11,'2012-04-09 10:38:31','2012-04-09 10:39:06'),(105,3,NULL,'105','Recette','envoyee',4500,4500,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','www.aser.com',NULL,32,NULL,11,'2012-04-09 10:40:48','2012-04-09 10:45:31'),(106,3,0,'106','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-23',1,NULL,'0','',NULL,32,NULL,11,'2012-04-09 10:49:57','2012-04-09 10:50:03'),(107,3,9,'107','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','test',NULL,32,NULL,11,'2012-04-09 11:12:47','2012-04-09 11:13:31'),(108,3,9,'108','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-03-24',NULL,1,NULL,'0','tets',NULL,31,NULL,11,'2012-04-09 11:20:34','2012-04-09 11:20:49'),(109,3,9,'109','Recette','envoyee',1500,1500,229,'BIF','canceled','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 11:21:45','2012-04-09 11:27:01'),(110,3,9,'110','Recette','envoyee',1500,1500,229,'BIF','canceled','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 11:31:31','2012-04-09 11:31:51'),(111,3,9,'111','Recette','envoyee',1500,0,229,'BIF','payee','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 11:42:20','2012-04-09 11:44:19'),(112,3,9,'112','Recette','envoyee',1500,0,229,'BIF','canceled','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 11:44:26','2012-04-09 11:44:40'),(113,3,0,'113','Recette','envoyee',1500,0,229,'BIF','canceled','2012-03-24','2012-04-23',1,NULL,'0','',NULL,31,NULL,11,'2012-04-09 11:45:46','2012-04-09 11:46:08'),(114,3,0,'114','Recette','envoyee',1500,0,229,'BIF','canceled','2012-03-24','2012-04-23',1,NULL,'0','',NULL,32,NULL,11,'2012-04-09 11:47:06','2012-04-09 11:47:20'),(115,3,9,'115','Recette','envoyee',1500,1500,229,'BIF','canceled','2012-03-24','2012-04-23',1,NULL,'0','',NULL,32,NULL,11,'2012-04-09 11:48:40','2012-04-09 11:52:55'),(116,NULL,5,'116','Reservation ','envoyee',560,560,86,'USD','canceled','2012-04-09','2012-04-23',1,NULL,NULL,'',NULL,NULL,NULL,11,'2012-04-09 12:12:19','2012-04-09 12:15:46'),(117,NULL,5,'117','Reservation ','envoyee',1170,0,179,'USD','canceled','2012-04-19','2012-04-20',1,NULL,NULL,'',NULL,NULL,NULL,11,'2012-04-09 13:37:25','2012-04-18 17:40:59'),(118,NULL,9,'118','Reservation ','envoyee',2000,1950,305,'USD','canceled','2012-04-09','2012-04-23',1,NULL,NULL,'',NULL,NULL,NULL,11,'2012-04-09 13:41:15','2012-04-18 17:23:54'),(119,NULL,9,'119','Service rendu','envoyee',15000,14000,2288,'BIF','avance','2012-04-09','2012-04-23',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-04-09 13:51:02','2012-04-11 11:43:55'),(120,NULL,7,'120','Service rendu','envoyee',100010,0,15256,'BIF','payee','2012-04-10','2012-04-24',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-04-10 15:23:50','2012-04-10 15:23:51'),(121,NULL,10,'121','Reservation ','envoyee',150,150,23,'BIF','canceled','2012-04-11','2012-04-25',1,NULL,NULL,'',NULL,NULL,NULL,11,'2012-04-11 14:21:55','2012-04-18 17:24:28'),(122,NULL,11,'122','Reservation ','envoyee',240,0,37,'USD','payee','2012-04-11','2012-04-25',0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2012-04-11 14:35:44','2012-04-11 14:35:44'),(123,NULL,5,'123','Service rendu','envoyee',1000,1000,152,'BIF','credit','2012-04-11','2012-04-25',0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2012-04-11 14:42:34','2012-04-11 14:42:34'),(124,NULL,8,'124','Approvisionement ','recu',1500,1500,229,'BIF','credit','2012-04-13','2012-04-27',0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2012-04-13 08:11:04','2012-04-13 08:11:04'),(125,NULL,12,'125','Approvisionement ','recu',3500,0,534,'BIF','payee','2012-04-13','2012-04-13',0,NULL,NULL,'',NULL,NULL,NULL,11,'2012-04-13 08:47:57','2012-04-13 10:04:35'),(126,NULL,13,'126','Approvisionement ','recu',6579,6579,1004,'BIF','credit','2012-04-09','2012-04-13',0,NULL,NULL,NULL,NULL,NULL,NULL,35,'2012-04-13 10:17:41','2012-04-13 10:18:35'),(127,NULL,9,'127','Proforma ','envoyee',250000,0,38136,'BIF','proforma','2012-04-13',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,35,'2012-04-13 10:41:26','2012-04-13 10:41:26'),(128,18,0,'128','Recette','envoyee',2400,0,366,'BIF','payee','2012-04-13','2012-04-27',1,NULL,'10','',NULL,32,NULL,30,'2012-04-13 10:59:43','2012-04-13 11:25:41'),(129,18,0,'129','Recette','envoyee',5700,0,870,'BIF','payee','2012-04-13','2012-04-27',1,NULL,'0','',NULL,31,NULL,30,'2012-04-13 11:03:45','2012-04-13 11:10:49'),(130,18,1,'130','Recette','envoyee',18500,18500,2822,'BIF','credit','2012-04-13','2012-04-27',1,NULL,'0','',NULL,32,NULL,30,'2012-04-13 11:14:45','2012-04-13 11:26:55'),(131,18,NULL,'131','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-04-13',NULL,1,1,'0','refus du client',NULL,31,NULL,30,'2012-04-13 11:32:49','2012-04-13 11:34:55'),(132,18,0,'132','Recette','envoyee',24000,0,3661,'BIF','payee','2012-04-13','2012-04-27',1,NULL,'0','',NULL,32,NULL,30,'2012-04-13 11:35:40','2012-04-13 12:06:20'),(133,NULL,13,'133','Approvisionement ','recu',1000,500,152,'BIF','avance','2012-04-14','2012-04-28',0,NULL,NULL,NULL,NULL,NULL,NULL,11,'2012-04-14 12:36:52','2012-04-14 12:36:52'),(134,19,14,'134','Recette','envoyee',17500,17500,2670,'BIF','credit','2012-04-17','2012-05-01',1,NULL,'2','',NULL,32,NULL,30,'2012-04-17 09:19:20','2012-04-17 09:23:33'),(135,19,0,'135','Recette','envoyee',13000,0,1983,'BIF','payee','2012-04-17','2012-05-01',1,NULL,'1','',NULL,31,NULL,30,'2012-04-17 09:20:48','2012-04-17 09:24:09'),(136,19,0,'136','Recette','envoyee',6000,0,915,'BIF','payee','2012-04-17','2012-05-01',1,NULL,'1','',NULL,31,NULL,30,'2012-04-17 09:22:26','2012-04-17 09:24:19'),(137,19,9,'137','Recette','envoyee',22700,22700,3463,'BIF','credit','2012-04-17','2012-05-01',1,NULL,'0','',NULL,31,NULL,30,'2012-04-17 09:33:28','2012-04-17 09:34:09'),(138,20,0,'138','Recette','envoyee',18900,0,2883,'BIF','payee','2012-04-17','2012-05-01',1,1,'6','',NULL,32,NULL,30,'2012-04-17 11:17:09','2012-04-17 11:40:37'),(139,20,9,'139','Recette','envoyee',10500,10500,1602,'BIF','credit','2012-04-17','2012-05-01',1,NULL,'0','',NULL,31,NULL,30,'2012-04-17 11:38:04','2012-04-17 11:39:44'),(140,20,15,'140','Recette','envoyee',3000,0,458,'BIF','payee','2012-04-17','2012-05-01',1,NULL,'0','',NULL,33,NULL,30,'2012-04-17 11:41:13','2012-04-17 12:06:53'),(141,20,15,'141','Recette','envoyee',17000,5000,2593,'BIF','avance','2012-04-17','2012-05-01',1,NULL,'4','',NULL,31,NULL,30,'2012-04-17 12:02:40','2012-04-17 12:03:46'),(142,20,NULL,'142','Recette','envoyee',1500,1500,0,'BIF','canceled','2012-04-17',NULL,1,1,'0','erreur du serveur eric',NULL,32,NULL,30,'2012-04-17 12:11:17','2012-04-17 12:12:15'),(143,3,NULL,'143','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'10',NULL,NULL,32,'___',11,'2012-04-18 15:19:11','2012-04-18 15:19:11'),(144,3,NULL,'144','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-03-24',NULL,0,NULL,'10',NULL,NULL,32,'___',11,'2012-04-18 15:20:01','2012-04-18 15:20:01'),(145,22,NULL,'145','Recette','envoyee',1500,1500,0,'BIF','cloturer','2012-04-18',NULL,0,1,'0',NULL,NULL,31,'___',30,'2012-04-18 15:20:44','2012-04-18 15:48:55'),(146,22,NULL,'146','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-04-18',NULL,0,NULL,'0',NULL,NULL,32,'7654',30,'2012-04-18 15:21:25','2012-04-18 15:21:25'),(147,22,NULL,'147','Recette','envoyee',1500,1500,0,'BIF','en_cours','2012-04-18',NULL,0,NULL,'0',NULL,NULL,31,NULL,30,'2012-04-18 15:22:08','2012-04-18 15:22:08'),(148,22,NULL,'148','Recette','envoyee',1500,1500,0,'BIF','cloturer','2012-04-18',NULL,0,1,'0',NULL,NULL,31,'1991',30,'2012-04-18 15:30:23','2012-04-18 15:45:04'),(149,22,NULL,'149','Recette','envoyee',1500,1500,0,'BIF','cloturer','2012-04-18',NULL,0,1,'0',NULL,NULL,31,'',30,'2012-04-18 15:49:53','2012-04-18 15:55:44');
/*!40000 ALTER TABLE `factures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonctions`
--

LOCK TABLES `fonctions` WRITE;
/*!40000 ALTER TABLE `fonctions` DISABLE KEYS */;
INSERT INTO `fonctions` VALUES (1,'Serveurs','',0,'2011-11-24 15:55:13','2011-11-24 15:55:13'),(2,'Caisses','',0,'2011-11-24 15:56:59','2011-11-24 15:56:59'),(3,'admin','',0,'2011-12-12 18:01:45','2011-12-12 18:01:45'),(4,'Reception','',11,'2011-12-20 15:24:25','2011-12-20 15:24:25'),(5,'superviseurs','',11,'2011-12-31 17:06:35','2011-12-31 17:06:35'),(6,'Consultations','',11,'2012-01-26 15:51:03','2012-01-26 15:51:03');
/*!40000 ALTER TABLE `fonctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupes`
--

LOCK TABLES `groupes` WRITE;
/*!40000 ALTER TABLE `groupes` DISABLE KEYS */;
INSERT INTO `groupes` VALUES (1,1,'General','',19,'2011-06-07 11:20:43','2011-12-12 19:04:10'),(6,4,'cartes','',11,'2012-01-07 17:28:12','2012-01-07 17:28:12'),(7,1,'brarudi','',25,'2012-01-19 12:34:09','2012-01-19 12:34:09'),(8,1,'liqueurs','',25,'2012-01-19 12:34:45','2012-01-19 12:34:45'),(9,1,'vins','',25,'2012-01-26 18:09:37','2012-01-26 18:09:37'),(10,1,'eau','',25,'2012-01-26 18:14:46','2012-01-26 18:14:46'),(11,1,'jus','',25,'2012-01-26 18:20:10','2012-01-26 18:20:10'),(12,5,'poulet','',25,'2012-01-26 19:02:35','2012-01-26 19:02:35'),(13,5,'ingredients','',11,'2012-03-21 11:49:14','2012-03-21 11:49:14'),(14,6,'vehicules','',35,'2012-04-11 10:03:05','2012-04-11 10:03:05'),(15,6,'groupes elct','',35,'2012-04-11 10:04:19','2012-04-11 10:04:19');
/*!40000 ALTER TABLE `groupes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historiques`
--

DROP TABLE IF EXISTS `historiques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historiques` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_operation` date NOT NULL,
  `num_operation` bigint(20) NOT NULL,
  `num_debit` bigint(20) DEFAULT NULL,
  `num_credit` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `famille` varchar(50) DEFAULT NULL,
  `sous_famille` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `id_element` bigint(20) DEFAULT NULL,
  `libelle` text NOT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `monnaie` varchar(50) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiques`
--

LOCK TABLES `historiques` WRITE;
/*!40000 ALTER TABLE `historiques` DISABLE KEYS */;
INSERT INTO `historiques` VALUES (63,'2012-04-17',14,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°140',NULL,0,'BIF',30,'2012-04-17 11:42:04'),(62,'2012-04-17',13,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°140',0,NULL,'BIF',30,'2012-04-17 11:41:13'),(61,'2012-04-17',13,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°140',NULL,0,'BIF',30,'2012-04-17 11:41:13'),(60,'2012-04-17',12,NULL,40,'actif','cpte_financier','caisses','Caiss',2,'Paiement Vente facture NÂ°138',18900,NULL,'BIF',30,'2012-04-17 11:40:37'),(59,'2012-04-17',12,30,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°138',NULL,18900,'BIF',30,'2012-04-17 11:40:37'),(58,'2012-04-17',11,NULL,NULL,'actif','cpte_tier','clients','Tier',9,'Vente Ã  credit Facture NÂ°139',10500,NULL,'BIF',30,'2012-04-17 11:39:44'),(57,'2012-04-17',11,30,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°139',NULL,10500,'BIF',30,'2012-04-17 11:39:44'),(56,'2012-04-17',10,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°139',0,NULL,'BIF',30,'2012-04-17 11:38:19'),(55,'2012-04-17',10,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°139',NULL,0,'BIF',30,'2012-04-17 11:38:19'),(54,'2012-04-17',9,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°139',0,NULL,'BIF',30,'2012-04-17 11:38:14'),(53,'2012-04-17',9,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°139',NULL,0,'BIF',30,'2012-04-17 11:38:14'),(52,'2012-04-17',8,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°139',0,NULL,'BIF',30,'2012-04-17 11:38:04'),(51,'2012-04-17',8,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°139',NULL,0,'BIF',30,'2012-04-17 11:38:04'),(50,'2012-04-17',7,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°138',0,NULL,'BIF',30,'2012-04-17 11:19:46'),(49,'2012-04-17',7,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°138',NULL,0,'BIF',30,'2012-04-17 11:19:46'),(48,'2012-04-17',6,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°138',0,NULL,'BIF',30,'2012-04-17 11:19:35'),(47,'2012-04-17',6,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°138',NULL,0,'BIF',30,'2012-04-17 11:19:35'),(46,'2012-04-17',5,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°138',0,NULL,'BIF',30,'2012-04-17 11:19:24'),(45,'2012-04-17',5,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°138',NULL,0,'BIF',30,'2012-04-17 11:19:24'),(44,'2012-04-17',4,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°138',0,NULL,'BIF',30,'2012-04-17 11:17:09'),(43,'2012-04-17',4,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°138',NULL,0,'BIF',30,'2012-04-17 11:17:09'),(42,'2012-04-17',3,NULL,NULL,'actif','cpte_financier','caisses','Caiss',3,'Virement de la caisse : bar vers la caisse : comptable',5000,NULL,'BIF',11,'2012-04-17 10:39:27'),(41,'2012-04-17',3,NULL,NULL,'actif','cpte_financier','caisses','Caiss',2,'Virement de la caisse : bar vers la caisse : comptable',NULL,5000,'BIF',11,'2012-04-17 10:39:27'),(40,'2012-04-17',2,NULL,NULL,'actif','cpte_charge',NULL,'Type',6,'achat oignons',5000,NULL,'BIF',11,'2012-04-17 10:11:08'),(39,'2012-04-17',2,NULL,40,'actif','cpte_financier','caisses','Caiss',3,'achat oignons',NULL,5000,'BIF',11,'2012-04-17 10:11:08'),(38,'2012-04-17',1,NULL,NULL,'passif','cpte_produit',NULL,'Type',1,'vente service',NULL,10000,'BIF',11,'2012-04-17 10:10:36'),(37,'2012-04-17',1,NULL,40,'actif','cpte_financier','caisses','Caiss',3,'vente service',10000,NULL,'BIF',11,'2012-04-17 10:10:36'),(64,'2012-04-17',14,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°140',0,NULL,'BIF',30,'2012-04-17 11:42:04'),(65,'2012-04-17',15,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°140',NULL,0,'BIF',30,'2012-04-17 11:42:08'),(66,'2012-04-17',15,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°140',0,NULL,'BIF',30,'2012-04-17 11:42:08'),(67,'2012-04-17',16,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Annulation de la vente de marchandises facture NÂ°140',0,NULL,'BIF',30,'2012-04-17 11:42:23'),(68,'2012-04-17',16,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Annulation de la vente de marchandises facture NÂ°140',NULL,0,'BIF',30,'2012-04-17 11:42:23'),(69,'2012-04-17',17,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Annulation de la vente de marchandises facture NÂ°140',0,NULL,'BIF',30,'2012-04-17 11:42:46'),(70,'2012-04-17',17,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Annulation de la vente de marchandises facture NÂ°140',NULL,0,'BIF',30,'2012-04-17 11:42:46'),(71,'2012-04-17',18,30,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°140',NULL,3000,'BIF',36,'2012-04-17 11:59:26'),(72,'2012-04-17',18,NULL,NULL,'actif','cpte_tier','clients','Tier',15,'Vente Ã  credit Facture NÂ°140',3000,NULL,'BIF',36,'2012-04-17 11:59:26'),(73,'2012-04-17',19,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°141',NULL,0,'BIF',30,'2012-04-17 12:02:40'),(74,'2012-04-17',19,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°141',0,NULL,'BIF',30,'2012-04-17 12:02:40'),(75,'2012-04-17',20,30,NULL,'passif','cpte_produit','stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°141',NULL,17000,'BIF',30,'2012-04-17 12:03:46'),(76,'2012-04-17',20,NULL,NULL,'actif','cpte_tier','clients','Tier',15,'Vente Ã  credit Facture NÂ°141',5000,NULL,'BIF',30,'2012-04-17 12:03:46'),(77,'2012-04-17',20,NULL,40,'actif','cpte_financier','caisses','Caiss',2,'Paiement Vente facture NÂ°141',12000,NULL,'BIF',30,'2012-04-17 12:03:46'),(78,'2012-04-17',21,NULL,NULL,'actif','cpte_tier','clients','Tier',15,'Paiement de la facture  NÂ°140',NULL,3000,'BIF',30,'2012-04-17 12:06:53'),(79,'2012-04-17',21,40,NULL,'actif','cpte_financier','caisses','Caiss',2,'Remboursement de la facture NÂ°140',3000,NULL,'BIF',30,'2012-04-17 12:06:53'),(80,'2012-04-17',22,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°142',NULL,1000,'BIF',30,'2012-04-17 12:11:17'),(81,'2012-04-17',22,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°142',1000,NULL,'BIF',30,'2012-04-17 12:11:17'),(82,'2012-04-17',23,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Annulation de la vente de marchandises facture NÂ°142',1000,NULL,'BIF',30,'2012-04-17 12:12:15'),(83,'2012-04-17',23,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Annulation de la vente de marchandises facture NÂ°142',NULL,1000,'BIF',30,'2012-04-17 12:12:15'),(84,'2012-03-24',24,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°143',NULL,1000,'BIF',11,'2012-04-18 15:19:11'),(85,'2012-03-24',24,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°143',1000,NULL,'BIF',11,'2012-04-18 15:19:11'),(86,'2012-03-24',25,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°144',NULL,1000,'BIF',11,'2012-04-18 15:20:01'),(87,'2012-03-24',25,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°144',1000,NULL,'BIF',11,'2012-04-18 15:20:01'),(88,'2012-04-18',26,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°145',NULL,1000,'BIF',30,'2012-04-18 15:20:44'),(89,'2012-04-18',26,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°145',1000,NULL,'BIF',30,'2012-04-18 15:20:44'),(90,'2012-04-18',27,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°146',NULL,1000,'BIF',30,'2012-04-18 15:21:25'),(91,'2012-04-18',27,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°146',1000,NULL,'BIF',30,'2012-04-18 15:21:25'),(92,'2012-04-18',28,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°147',NULL,1000,'BIF',30,'2012-04-18 15:22:08'),(93,'2012-04-18',28,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°147',1000,NULL,'BIF',30,'2012-04-18 15:22:08'),(94,'2012-04-18',29,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°148',NULL,1000,'BIF',30,'2012-04-18 15:30:23'),(95,'2012-04-18',29,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°148',1000,NULL,'BIF',30,'2012-04-18 15:30:23'),(96,'2012-04-18',30,30,NULL,'actif','cpte_stock','marchandises',NULL,NULL,'Vente de marchandises facture NÂ°149',NULL,1000,'BIF',30,'2012-04-18 15:49:53'),(97,'2012-04-18',30,NULL,NULL,'actif','cpte_charge','cout_stocks_vendus',NULL,NULL,'Vente de marchandises facture NÂ°149',1000,NULL,'BIF',30,'2012-04-18 15:49:53'),(98,'2012-04-18',31,NULL,40,'actif','cpte_financier','caisses','Caiss',2,'Annulation du Paiement Vente facture NÂ°118',NULL,50,'USD',11,'2012-04-18 17:23:55'),(99,'2012-04-18',31,NULL,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'Annulation de l\' HÃ©bergement facture NÂ°118',2000,NULL,'USD',11,'2012-04-18 17:23:55'),(100,'2012-04-18',31,NULL,NULL,'actif','cpte_tier','clients','Tier',9,'Annulation Reservation Ã  credit Facture NÂ°118',NULL,1950,'USD',11,'2012-04-18 17:23:55'),(101,'2012-04-18',32,NULL,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'Annulation de l\' HÃ©bergement facture NÂ°121',150,NULL,'BIF',11,'2012-04-18 17:24:13'),(102,'2012-04-18',32,NULL,NULL,'actif','cpte_tier','clients','Tier',10,'Annulation Reservation Ã  credit Facture NÂ°121',NULL,150,'BIF',11,'2012-04-18 17:24:13'),(103,'2012-04-18',33,NULL,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'Annulation de l\' HÃ©bergement facture NÂ°121',150,NULL,'BIF',11,'2012-04-18 17:24:28'),(104,'2012-04-18',33,NULL,NULL,'actif','cpte_tier','clients','Tier',10,'Annulation Reservation Ã  credit Facture NÂ°121',NULL,150,'BIF',11,'2012-04-18 17:24:28'),(105,'2012-04-18',34,NULL,40,'actif','cpte_financier','caisses','Caiss',3,'Annulation du Paiement Vente facture NÂ°117',NULL,1170,'USD',11,'2012-04-18 17:40:59'),(106,'2012-04-18',34,NULL,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'Annulation de l\' HÃ©bergement facture NÂ°117',1170,NULL,'USD',11,'2012-04-18 17:40:59'),(107,'2012-04-18',35,NULL,40,'actif','cpte_financier','caisses','Caiss',2,'Annulation du Paiement Vente facture NÂ°84',NULL,864,'USD',11,'2012-04-18 17:46:01'),(108,'2012-04-18',35,NULL,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'Annulation de l\' HÃ©bergement facture NÂ°84',900,NULL,'USD',11,'2012-04-18 17:46:01'),(109,'2012-04-18',35,NULL,NULL,'actif','cpte_tier','clients','Tier',5,'Annulation Reservation Ã  credit Facture NÂ°84',NULL,36,'USD',11,'2012-04-18 17:46:01'),(110,'2012-04-18',36,NULL,NULL,'passif','cpte_produit','hebergement',NULL,NULL,'Annulation de l\' HÃ©bergement facture NÂ°64',2925,NULL,'USD',11,'2012-04-18 17:46:17'),(111,'2012-04-18',36,NULL,NULL,'actif','cpte_tier','clients','Tier',1,'Annulation Reservation Ã  credit Facture NÂ°64',NULL,2925,'USD',11,'2012-04-18 17:46:17');
/*!40000 ALTER TABLE `historiques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immobilisations`
--

DROP TABLE IF EXISTS `immobilisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immobilisations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type_immobilisation_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantite` double DEFAULT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `localisation` text NOT NULL,
  `taux` int(11) DEFAULT NULL,
  `anterieure` double DEFAULT NULL,
  `cumul` double DEFAULT NULL,
  `VNC` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immobilisations`
--

LOCK TABLES `immobilisations` WRITE;
/*!40000 ALTER TABLE `immobilisations` DISABLE KEYS */;
INSERT INTO `immobilisations` VALUES (1,1,'Umuco house',NULL,100000000,'BIF','2012-04-05','',10,NULL,NULL,NULL),(2,3,'toyota corolla',NULL,5000000,'BIF','2012-04-05','',25,NULL,NULL,NULL),(3,2,'meubles',NULL,1000000,'BIF','2012-04-05','',20,NULL,NULL,NULL);
/*!40000 ALTER TABLE `immobilisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journals`
--

DROP TABLE IF EXISTS `journals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `observation` text,
  `personnel_id` int(11) NOT NULL,
  `closed` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journals`
--

LOCK TABLES `journals` WRITE;
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;
INSERT INTO `journals` VALUES (1,1,'2012-03-24',NULL,30,1,'2012-03-24 20:20:03','2012-03-26 10:37:31'),(2,1,'2012-03-24',NULL,29,0,'2012-03-24 20:53:14','2012-03-24 20:53:14'),(3,1,'2012-03-24',NULL,11,0,'2012-03-24 20:35:48','2012-03-24 20:35:48'),(4,1,'2012-03-26',NULL,30,1,'2012-03-26 13:16:13','2012-03-26 17:49:29'),(5,2,'2012-03-26',NULL,30,1,'2012-03-26 14:45:45','2012-03-26 14:46:11'),(6,3,'2012-03-26',NULL,30,1,'2012-03-26 17:47:57','2012-03-26 17:50:25'),(7,4,'2012-03-26',NULL,30,1,'2012-03-26 18:05:30','2012-03-26 18:05:54'),(8,5,'2012-03-26',NULL,30,1,'2012-03-26 18:34:59','2012-03-27 11:24:55'),(9,1,'2012-03-27','test',30,1,'2012-03-27 16:48:47','2012-03-28 18:08:27'),(10,1,'2012-03-28','hello world',30,1,'2012-03-28 18:12:35','2012-03-28 18:13:08'),(11,2,'2012-03-28','ttt',30,1,'2012-03-28 18:14:25','2012-03-28 18:15:12'),(12,3,'2012-03-28','ttrreeee',30,1,'2012-03-28 18:19:49','2012-03-28 18:20:34'),(13,4,'2012-03-28','blablah',30,1,'2012-03-28 18:25:52','2012-03-30 22:55:49'),(14,1,'2012-03-30','',30,1,'2012-03-30 22:56:16','2012-03-31 11:35:00'),(15,1,'2012-03-31','',30,1,'2012-03-31 11:39:32','2012-04-03 18:36:03'),(16,1,'2012-04-03','',30,1,'2012-04-03 18:36:17','2012-04-05 18:55:55'),(17,1,'2012-04-05','',30,1,'2012-04-05 19:51:54','2012-04-08 22:21:59'),(18,1,'2012-04-13','',30,1,'2012-04-13 10:59:43','2012-04-13 12:08:37'),(19,1,'2012-04-17','',30,1,'2012-04-17 09:19:20','2012-04-17 09:42:23'),(20,2,'2012-04-17','yyyyyyy',30,1,'2012-04-17 11:17:09','2012-04-17 12:14:23'),(21,1,'2012-04-17',NULL,36,0,'2012-04-17 11:59:26','2012-04-17 11:59:26'),(22,1,'2012-04-18',NULL,30,0,'2012-04-18 15:20:44','2012-04-18 15:20:44');
/*!40000 ALTER TABLE `journals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lettres`
--

DROP TABLE IF EXISTS `lettres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lettres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expediteur` varchar(50) NOT NULL,
  `destinataire` varchar(50) NOT NULL,
  `objet` text NOT NULL,
  `numero` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lettres`
--

LOCK TABLES `lettres` WRITE;
/*!40000 ALTER TABLE `lettres` DISABLE KEYS */;
INSERT INTO `lettres` VALUES (1,'Top One','MinistÃ¨re des Finances','DÃ©claration de crÃ©ances','105/T1PC/2012','envoyes','','2012-04-13',35,'2012-04-13 10:53:42','2012-04-13 10:53:42');
/*!40000 ALTER TABLE `lettres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_extras`
--

DROP TABLE IF EXISTS `location_extras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location_extras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `quantite` double NOT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_extras`
--

LOCK TABLES `location_extras` WRITE;
/*!40000 ALTER TABLE `location_extras` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_extras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_transports`
--

DROP TABLE IF EXISTS `location_transports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location_transports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proprietaire` varchar(50) NOT NULL,
  `chauffeur` varchar(50) NOT NULL,
  `montant_location` double NOT NULL,
  `avance_location` double NOT NULL,
  `reste_location` double NOT NULL,
  `tier_id` bigint(20) unsigned DEFAULT NULL,
  `montant_transport` double NOT NULL,
  `avance_transport` double NOT NULL,
  `reste_transport` double NOT NULL,
  `monaie` varchar(50) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `contenu` varchar(50) DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `PU` double DEFAULT NULL,
  `carburant` int(11) DEFAULT NULL,
  `observation` text,
  `date_depart` date DEFAULT NULL,
  `date_checked_in` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_transports`
--

LOCK TABLES `location_transports` WRITE;
/*!40000 ALTER TABLE `location_transports` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_transports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) DEFAULT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `salle_id` int(11) NOT NULL,
  `entree` date NOT NULL,
  `sortie` date NOT NULL,
  `moment` varchar(50) NOT NULL,
  `location` double DEFAULT NULL,
  `extras` double NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mouvements`
--

DROP TABLE IF EXISTS `mouvements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mouvements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `unite_id` int(11) NOT NULL,
  `stock_sortant_id` bigint(20) DEFAULT NULL,
  `first_personnel_id` bigint(20) DEFAULT NULL,
  `creation` datetime NOT NULL,
  `modification` datetime NOT NULL,
  `stock_entrant_id` bigint(20) DEFAULT NULL,
  `second_personnel_id` bigint(20) DEFAULT NULL,
  `confirmation` datetime DEFAULT NULL,
  `echange` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mouvements`
--

LOCK TABLES `mouvements` WRITE;
/*!40000 ALTER TABLE `mouvements` DISABLE KEYS */;
/*!40000 ALTER TABLE `mouvements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `date_engagement` date NOT NULL,
  `fonction_id` int(50) NOT NULL,
  `actif` varchar(50) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `mot_passe` varchar(50) NOT NULL,
  `last_action` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnels`
--

LOCK TABLES `personnels` WRITE;
/*!40000 ALTER TABLE `personnels` DISABLE KEYS */;
INSERT INTO `personnels` VALUES (11,'armand','','','0000-00-00',3,'oui','armand','86856242a17b0d05d214ac9d6b9415ed9b6a025e','2012-04-19 09:48:05','2011-12-12 18:02:25','2012-04-19 09:48:05'),(32,'Eric','','','0000-00-00',1,'oui','','08b089710725cf4c00a4e6895e715f022283bbf4',NULL,'2012-03-24 20:09:48','2012-03-24 20:09:48'),(31,'Alain','','','0000-00-00',1,'oui','','08b089710725cf4c00a4e6895e715f022283bbf4',NULL,'2012-03-24 20:09:31','2012-03-24 20:09:31'),(30,'CITEGETSE Filde','','','0000-00-00',2,'oui','filde','47fc30e520bc53cc5c8d4695d14ede3774fc6e68','2012-04-17 16:06:31','2012-03-24 20:08:20','2012-04-18 16:06:31'),(29,'KAZE Grace','','','0000-00-00',2,'oui','grace','b11244d84c17ecb33229fa7668eaf6b8be4f19bf','2012-04-01 15:22:14','2012-03-24 20:06:49','2012-04-02 15:22:14'),(28,'emmanuel','','','0000-00-00',5,'oui','emma','c2087f8692a20e80a560645a145bd1a5ca8767b8','2012-03-23 20:10:21','2012-03-24 20:02:51','2012-03-24 20:10:21'),(33,'serveur','','','0000-00-00',1,'oui','serveur','617c4dd8e08fe471495cbc35d94d2b5c5ce89e92','2012-04-01 15:21:56','2012-03-31 11:33:14','2012-04-02 15:21:56'),(35,'kagabo albert','78821739','bujumbura','2012-04-30',5,'oui','albert','c2fb33457433aed0457164156e366868e59d6c74','2012-04-12 10:57:02','2012-04-11 09:40:51','2012-04-13 10:57:02'),(36,'Evariste','79000212','','0000-00-00',5,'oui','evariste','d601f885ca3707e7466e6abcb1b29d11041baf0d','2012-04-16 12:01:35','2012-04-17 11:45:45','2012-04-17 12:01:35');
/*!40000 ALTER TABLE `personnels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertes`
--

DROP TABLE IF EXISTS `pertes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pertes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bon_id` bigint(20) DEFAULT NULL,
  `produit_id` bigint(20) unsigned NOT NULL,
  `nature` varchar(50) NOT NULL,
  `quantite` double unsigned NOT NULL,
  `unite_id` double NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `echange` varchar(50) NOT NULL,
  `expiration_details` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertes`
--

LOCK TABLES `pertes` WRITE;
/*!40000 ALTER TABLE `pertes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pertes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pret_operations`
--

DROP TABLE IF EXISTS `pret_operations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pret_operations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `operation` varchar(50) NOT NULL,
  `produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `unite_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pret_operations`
--

LOCK TABLES `pret_operations` WRITE;
/*!40000 ALTER TABLE `pret_operations` DISABLE KEYS */;
/*!40000 ALTER TABLE `pret_operations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prets`
--

DROP TABLE IF EXISTS `prets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) unsigned NOT NULL,
  `produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `unite_id` int(11) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prets`
--

LOCK TABLES `prets` WRITE;
/*!40000 ALTER TABLE `prets` DISABLE KEYS */;
/*!40000 ALTER TABLE `prets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit_details`
--

DROP TABLE IF EXISTS `produit_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produit_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `PA` double NOT NULL,
  `date` date NOT NULL,
  `batch` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit_details`
--

LOCK TABLES `produit_details` WRITE;
/*!40000 ALTER TABLE `produit_details` DISABLE KEYS */;
INSERT INTO `produit_details` VALUES (6,0,1,0,'0000-00-00',NULL),(25,0,10,1000,'2012-03-15',NULL),(90,28149,1144,1000,'2012-03-22',NULL),(87,28155,7000,1,'2012-03-22',NULL),(96,28156,1000000,1000,'2012-03-22',NULL),(76,28156,64,110,'2012-03-21',NULL),(95,28155,100000,0.7,'2012-03-21',876),(88,28149,10,2500,'2012-03-22',NULL),(80,28155,3400,4,'2012-03-22',NULL),(67,28156,10,130,'2012-03-21',NULL),(97,28161,20,500,'2012-03-24',NULL),(98,28161,20,700,'2012-03-22',NULL),(99,28161,10,600,'2012-03-24',NULL),(100,28165,4,900,'2012-03-26',NULL),(104,28168,3,320,'2012-04-03',NULL),(105,28165,10,1000,'2012-04-07',NULL),(106,28168,10,450,'2012-04-07',NULL),(107,28168,12,500,'2012-04-05',NULL),(108,25,24,1000,'2012-04-04',NULL),(109,25,12,83.33,'2012-04-04',NULL),(110,22,10,2000,'2012-04-07',NULL),(111,17,75,1000,'2012-04-08',NULL),(112,28169,2,450,'2012-04-10',NULL),(113,28169,5,500,'2012-04-10',NULL),(114,28169,3,550,'2012-04-10',NULL),(115,28170,10,3000,'2012-04-11',NULL),(116,28169,10,500,'2012-04-13',NULL),(118,28169,12,83.33,'2012-04-14',NULL);
/*!40000 ALTER TABLE `produit_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produits` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `section_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `groupe_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `code` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `PA` double DEFAULT NULL,
  `PAMP` double DEFAULT NULL,
  `marge` int(11) DEFAULT NULL,
  `PVMP` double DEFAULT NULL,
  `PV` double DEFAULT NULL,
  `quantite` double DEFAULT NULL,
  `unite_id` bigint(20) NOT NULL,
  `total` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `relations` set('simple','figuratif','paquet_I','paquet_II','echange','composant_I','composant_II') NOT NULL DEFAULT 'simple',
  `min` int(11) DEFAULT '10',
  `expiration` tinyint(1) NOT NULL,
  `actif` varchar(50) DEFAULT 'oui',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28173 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produits`
--

LOCK TABLES `produits` WRITE;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` VALUES (28153,1,1,1,NULL,'ibiharage',0,NULL,NULL,NULL,1000,200,1,0,'BIF','figuratif',10,0,'oui'),(28152,1,1,10,NULL,'oo',100,NULL,NULL,NULL,1000,0,1,0,'BIF','figuratif',0,0,'oui'),(28151,1,1,1,NULL,'IGITI',0,0,NULL,0,0,0,1,0,'BIF','figuratif',10,0,'oui'),(27593,1,1,1,0,'ACAPULCO',0,NULL,NULL,0,1000,200,1,200000,'BIF','figuratif',NULL,0,'oui'),(27594,1,1,1,0,'AFRICAN THE MATIN',0,0,NULL,0,2500,0,1,0,'BIF','figuratif',NULL,0,'oui'),(27595,1,1,1,0,'AFRICAN THEA',0,0,NULL,0,2500,0,1,0,'BIF','figuratif',NULL,0,'oui'),(19888,1,1,1,0,'AGATOKE KO MUGATONDO',0,0,NULL,0,3000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(11070,1,1,1,0,'AMARULA',0,0,NULL,0,5000,0,0,0,'BIF','figuratif',NULL,0,'oui'),(4351,1,1,7,0,'AMSTEL 33CL',0,0,NULL,0,1200,0,1,0,'BIF','figuratif',NULL,0,'non'),(26,1,1,7,0,'AMSTEL 65 CL',0,0,NULL,0,2500,0,0,0,'BIF','figuratif',NULL,0,'non'),(17,1,1,7,0,'AMSTEL BOCK',1000,1000,50,1500,1500,75,4,75000,'BIF','simple',10,0,'oui'),(11430,1,1,1,0,'AMUSE GUEUL',0,NULL,NULL,NULL,10000,198,0,1980000,'BIF','figuratif',NULL,0,'oui'),(1,1,1,10,0,'Aquavie 0.3 cl',0,NULL,NULL,NULL,1200,197,1,236400,'BIF','figuratif',NULL,0,'oui'),(2,1,1,10,0,'AQUAVIE 1L',0,NULL,NULL,NULL,2000,201,0,402000,'BIF','figuratif',NULL,0,'oui'),(3,1,1,10,0,'AQUAVIE PETILLANTE  0.65 L',0,0,NULL,0,2000,0,0,0,'BIF','figuratif',NULL,0,'oui'),(162,1,1,1,0,'ARMAGNAC CLE DES DUCS',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(9238,1,1,1,0,'ASSIETTE DE BANANE',0,NULL,NULL,NULL,5000,200,2,2,'BIF','figuratif',NULL,0,'oui'),(13660,1,1,1,0,'ASSIETTE DE FRUIT',0,0,NULL,0,3000,0,0,0,'BIF','figuratif',NULL,0,'oui'),(10710,1,1,1,0,'AVOCAT FARCIE AUX CREVETTES',0,NULL,NULL,NULL,7000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11014,1,1,1,0,'AVOCAT VINAIGRETTE',0,NULL,NULL,NULL,3000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(4096,1,1,1,0,'BACARDI',0,0,NULL,0,7000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(160,1,1,1,0,'BAILEYS',0,NULL,NULL,NULL,7000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(124,1,1,1,0,'BANANA SPLIT',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(115,1,1,1,0,'BANANE ROTIE AU MIEL',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(23272,1,1,1,0,'BARON D;ARIGNAC',0,NULL,NULL,NULL,18000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(5389,1,1,1,0,'BAVARIA',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(1532,1,1,1,0,'BLACK LABEL',0,NULL,NULL,NULL,7500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(55,1,1,1,0,'BLUE LAGOON',0,NULL,NULL,NULL,12000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(5388,1,1,1,0,'BOOM',0,NULL,NULL,NULL,1500,200,1,2,'BIF','figuratif',NULL,0,'oui'),(130,1,1,1,0,'BOULE DE GLACE',0,NULL,NULL,NULL,3000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(9524,1,1,1,0,'BOULETTE',0,NULL,NULL,NULL,6000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(11795,1,1,1,0,'BOULETTE MAISON',0,NULL,NULL,NULL,2500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(69,1,1,1,0,'BOUQUET DE ROQUETTE AU JAMBON CRU ET PARMESAN',0,NULL,NULL,NULL,13500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(93,1,1,1,0,'BROCHETTE DE SAINT JACQUES AUX AGRUMES',0,NULL,NULL,NULL,29000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(24127,1,1,1,0,'BUFFET/30Personne',0,NULL,NULL,NULL,18000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(17073,1,1,1,0,'C REPE FRANCAISE ',0,NULL,NULL,NULL,6000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11068,1,1,1,0,'ananas',0,0,NULL,0,1000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(27627,1,1,1,0,'CAFE MATIN',0,NULL,NULL,NULL,2000,200,1,0,'BIF','figuratif',NULL,0,'oui'),(51,1,1,1,0,'CAIPIRINHA',0,NULL,NULL,NULL,10000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(53,1,1,1,0,'CAIPIROSKA',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(159,1,1,1,0,'CALVADOS PERE MAGLOIRE',0,NULL,NULL,NULL,9000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(33,1,1,1,0,'CAMPARI',0,NULL,NULL,NULL,7000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(34,1,1,1,0,'CAMPARI ORANGE',0,NULL,NULL,NULL,7500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(3595,1,1,1,0,'CAPITAINE AUX SAVEUR DÂ°ASIE',0,NULL,NULL,NULL,18000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(2870,1,1,1,0,'CAPITAINE GRATINE AUX EPINARD',0,NULL,NULL,NULL,19000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(165,1,1,1,0,'CAPPUCINO',0,NULL,NULL,NULL,3000,200,3,0,'BIF','figuratif',NULL,0,'oui'),(119,1,1,1,0,'CARPACCIO DE FRAISE AU BASILIC',0,NULL,NULL,NULL,9000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(150,1,1,1,0,'CHATEAU ARNAUD,2008',0,NULL,NULL,NULL,120000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(148,1,1,1,0,'CHATEAU FERRIERE,2006',0,NULL,NULL,NULL,150000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(153,1,1,1,0,'CHATEAU LALANDE,1999',0,NULL,NULL,NULL,180000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(151,1,1,1,0,'CHATEAU NEUF DU PAPE',0,NULL,NULL,NULL,150000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(152,1,1,1,0,'CHATEAU NEUF DU PAPE ,2007',0,NULL,NULL,NULL,140000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(149,1,1,1,0,'CHATEAU TEYNAC,2004',0,NULL,NULL,NULL,70000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(3844,1,1,1,0,'CHAUCOLAT',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(2406,1,1,1,0,'CHIVAS',0,NULL,NULL,NULL,7500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(167,1,1,1,0,'CHOCOLAT CHAUD',0,NULL,NULL,NULL,3000,199,3,995000,'BIF','figuratif',NULL,0,'oui'),(168,1,1,1,0,'CHOCOLAT VIENNOIS',0,NULL,NULL,NULL,3500,200,3,0,'BIF','figuratif',NULL,0,'oui'),(9525,1,1,1,0,'CLUB SANDWICH',0,NULL,NULL,NULL,3500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(4,1,1,7,0,'COCA COLA',0,NULL,NULL,NULL,1200,0,4,0,'BIF','figuratif',NULL,0,'non'),(23735,1,1,1,0,'COCA LIGHT',0,NULL,NULL,NULL,5000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(3843,1,1,1,0,'COCKTAIL',0,NULL,NULL,NULL,5000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(16307,1,1,1,0,'COCTAIL SOSUMO',0,NULL,NULL,NULL,8000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(77,1,1,1,0,'COEUR DE SAUMON STYLE CRAVELACK ',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(158,1,1,1,0,'COGNAC MARTEL',0,NULL,NULL,NULL,9500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(157,1,1,1,0,'COGNAC NAPOLEON',0,NULL,NULL,NULL,7000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(7832,1,1,1,0,'COINTREAU',0,NULL,NULL,NULL,7000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(4610,1,1,1,0,'CORDON BLEU DE POULET',0,NULL,NULL,NULL,13000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(11016,1,1,1,0,'COQUILLE DU LAC',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(28138,1,1,1,NULL,'TOAST',0,NULL,NULL,NULL,3000,200,1,600000,'BIF','figuratif',10,0,'oui'),(24557,1,1,1,0,'COTE DE PORC A L ARDENAISE',0,NULL,NULL,NULL,12000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(2636,1,1,1,0,'COTTELETTE D.AGNEAU',0,NULL,NULL,NULL,22000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(27587,1,1,1,0,'CRAFT',0,NULL,NULL,NULL,3000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(2401,1,1,1,0,'CREDIT DU 25/10/2011',0,NULL,NULL,NULL,328700,200,2,1,'BIF','figuratif',NULL,0,'oui'),(17462,1,1,1,0,'CREDIT PAYE DE J PIERRE',0,NULL,NULL,NULL,46200,200,3,0,'BIF','figuratif',NULL,0,'oui'),(114,1,1,1,0,'CREME BRULEES AUX 2 SAVEURS',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(80,1,1,1,0,'CREME DE POTIRON A L HUILE DE TRUFFES BLANCHES',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(13286,1,1,1,0,'CREPE AU  DEUX SUCRE',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(18637,1,1,1,0,'CREPE AU 2 SUCRES',0,NULL,NULL,NULL,2000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(18636,1,1,1,0,'CREPE AU MIEL MATIN',0,NULL,NULL,NULL,2000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11069,1,1,1,0,'CREPE AUX FRUIT FLAMBES',0,NULL,NULL,NULL,6000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(18638,1,1,1,0,'CREPE AUX FRUITS',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(15549,1,1,1,0,'CREPE COMEDIE FRANCAISE',0,NULL,NULL,NULL,6000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11062,1,1,1,0,'CREPE MICADO',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(18639,1,1,1,0,'CREPE MIKADO MATIN',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(14035,1,1,1,0,'CREPE NATURE',0,NULL,NULL,NULL,3000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(145,1,1,1,0,'CRISTAL RODERER,2004',0,NULL,NULL,NULL,650000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(2395,1,1,1,0,'CROISSANT AU BEURRE  CHOCOLAT',0,NULL,NULL,NULL,2000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1528,1,1,1,0,'CROISSANT JAMBON FROMAGE',0,NULL,NULL,NULL,2500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1527,1,1,1,0,'CROISSANT VIDE',0,NULL,NULL,NULL,1000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(22420,1,1,1,0,'CROQUE  MADAME',0,NULL,NULL,NULL,3500,200,1,2,'BIF','figuratif',NULL,0,'oui'),(170,1,1,1,0,'CROQUE MONSIER',0,NULL,NULL,NULL,4000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1529,1,1,1,0,'CROISSANT GOURMAND',0,NULL,NULL,NULL,3500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(45,1,1,1,0,'CUBA LIBRE',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11018,1,1,1,0,'CUISSE DE  GRENOUILLE SAUCE DIABLE',0,NULL,NULL,NULL,6000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11017,1,1,1,0,'CUISSE DE GRENOUILLE',0,NULL,NULL,NULL,5000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11051,1,5,12,0,'CUISSE DE POULET PROVINCAL',0,NULL,NULL,NULL,10000,200,2,2,'BIF','figuratif',NULL,0,'oui'),(11050,1,5,12,0,'CUISSE DE POULET ROTI',0,NULL,NULL,NULL,10000,200,2,2,'BIF','figuratif',NULL,0,'oui'),(11047,1,5,12,0,'CURRY DE POULET',0,NULL,NULL,NULL,13000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(48,1,1,1,0,'DAIQUIRI',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(123,1,1,1,0,'DAME BLANCHE',0,NULL,NULL,NULL,6000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(122,1,1,1,0,'DAME NOIRE',0,NULL,NULL,NULL,6000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(143,1,1,1,0,'DOM PERIGNON ,2002',0,NULL,NULL,NULL,380000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(10404,1,1,1,0,'DROIT DE BOUCHON VIN',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(12537,1,1,1,0,'DROSTY',0,NULL,NULL,NULL,10000,202,0,2020000,'BIF','figuratif',NULL,0,'oui'),(63,1,1,1,0,'EL DIABLO',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(3108,1,1,1,0,'ELBLING CLASSIC',0,NULL,NULL,NULL,30000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1122,1,1,1,0,'EMBALLAGE',0,NULL,NULL,NULL,1500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(919,1,1,1,0,'EMINCE DE BOEUF',0,NULL,NULL,NULL,14000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1742,1,1,1,0,'EPINARD',0,NULL,NULL,NULL,4000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(164,1,1,1,0,'EXPRESSO',0,NULL,NULL,NULL,1500,200,3,0,'BIF','figuratif',NULL,0,'oui'),(5,1,1,7,0,'FANTA CITRON',0,0,NULL,0,1500,0,0,0,'BIF','figuratif',NULL,0,'oui'),(185,1,1,7,0,'FANTA ORANGE',0,NULL,NULL,NULL,1200,201,0,241200,'BIF','figuratif',NULL,0,'oui'),(86,1,1,1,0,'FETTUCINI A LA MARSELAISE',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(85,1,1,1,0,'FETTUCINI EN DUO DE SAUMON',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11038,1,1,1,0,'FILET  DE BOEUF BEARNAISE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(10406,1,1,1,0,'FILET CHASSEUR',0,NULL,NULL,NULL,15000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(94,1,1,1,0,'FILET DE  CAPITAINE AUX EPICES',0,NULL,NULL,NULL,19000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1115,1,1,1,0,'FILET DE BEOUF CHAMPIGNON CREME',0,NULL,NULL,NULL,15000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(2871,1,1,1,0,'FILET DE BOEUF  NATURE',0,NULL,NULL,NULL,12000,202,2,2424000,'BIF','figuratif',NULL,0,'oui'),(11030,1,1,1,0,'FILET DE BOEUF A LA CREME D.AIL',0,NULL,NULL,NULL,14000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11031,1,1,1,0,'FILET DE BOEUF ARCHIDUC',0,NULL,NULL,NULL,15000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(10402,1,1,1,0,'FILET DE BOEUF AUX OIGNONS',0,NULL,NULL,NULL,17000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(1118,1,1,1,0,'FILET DE BOEUF CHAMPIGNON',0,NULL,NULL,NULL,15000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11032,1,1,1,0,'FILET DE BOEUF CHASSEUR',0,NULL,NULL,NULL,15000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(96,1,1,1,0,'FILET DE BOEUF ET SON OS A MOELLE',0,NULL,NULL,NULL,23000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11034,1,1,1,0,'FILET DE BOEUF NATURE AVEC SON JUS DE CUISSON',0,NULL,NULL,NULL,12000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11039,1,1,1,0,'FILET DE PORC A L.ARDENAISE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11040,1,1,1,0,'FILET DE PORC A MA FACON',0,NULL,NULL,NULL,10000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11029,1,1,1,0,'FILET POIVRE VERT CREME',0,NULL,NULL,NULL,16000,199,1,3184000,'BIF','figuratif',NULL,0,'oui'),(11035,1,1,1,0,'FILET POIVRE VERT FLAMBEE',0,NULL,NULL,NULL,17000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11033,1,1,1,0,'FILET PORTUGAISE',0,NULL,NULL,NULL,15000,203,1,3045000,'BIF','figuratif',NULL,0,'oui'),(11036,1,1,1,0,'FILET ROQUEFORT',0,NULL,NULL,NULL,16000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11037,1,1,1,0,'FILET STAR HOTEL',0,NULL,NULL,NULL,18000,199,1,3582000,'BIF','figuratif',NULL,0,'oui'),(176,1,1,1,0,'FINGERS DE MOZZARELLA ',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(177,1,5,12,0,'FINGERS DE POULET',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(918,1,1,1,0,'FIOLE DU PAPE',0,NULL,NULL,NULL,130000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(58,1,1,1,0,'FIRE BOMB',0,NULL,NULL,NULL,10000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(125,1,1,1,0,'FRAISE MELBA',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11045,1,5,12,0,'FRICASSE DE POULET A LA RATATOUILLE NICOISE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(4350,1,1,1,0,'FRUIT',0,NULL,NULL,NULL,1000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1959,1,1,1,0,'FRUIT DE SAISON',0,NULL,NULL,NULL,6500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(18635,1,1,1,0,'FRUIT DE SAISON MATIN',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(15,1,1,11,0,'FRUITO ANANAS',0,NULL,NULL,NULL,2000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(14,1,1,11,0,'FRUITO PASSION',0,NULL,NULL,NULL,2000,202,0,404000,'BIF','figuratif',NULL,0,'oui'),(95,1,1,1,0,'GAMBAS AUX TREIZE EPICES',0,NULL,NULL,NULL,35000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(79,1,1,1,0,'GASPACHO ,PETITS  LEGUMES ET GAMBAS GRILLEES',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(40,1,1,1,0,'GIMLET',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1531,1,1,1,0,'GIN',0,NULL,NULL,NULL,6000,200,1,1200000,'BIF','figuratif',NULL,0,'oui'),(41,1,1,1,0,'GIN FIZZ',0,NULL,NULL,NULL,8000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(42,1,1,1,0,'GIN SOUR',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(38,1,1,1,0,'GIN TONIC',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(5390,1,1,1,0,'GISASE WATER',0,NULL,NULL,NULL,1200,200,1,2,'BIF','figuratif',NULL,0,'oui'),(1324,1,1,1,0,'GLACE',0,NULL,NULL,NULL,7000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(3350,1,1,1,0,'GLACE CHOCOLAT',0,NULL,NULL,NULL,7000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(128,1,1,1,0,'GLACE COLONEL',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(3349,1,1,1,0,'GLACE FRAISE',0,NULL,NULL,NULL,7000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(183,1,1,1,0,'GLACE JAMAICAINE',0,NULL,NULL,NULL,11000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(129,1,1,1,0,'GLACE LA TRILOGIE DE CORNETS  SAVEUR',0,NULL,NULL,NULL,9000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1745,1,1,1,0,'GLACE MELBA',0,NULL,NULL,NULL,7000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1744,1,1,1,0,'GLACE VANILLE',0,NULL,NULL,NULL,7000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(922,1,1,1,0,'GRAND SIECLE',0,NULL,NULL,NULL,480000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(161,1,1,1,0,'GRAPPA',0,NULL,NULL,NULL,10000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11060,1,1,1,0,'GRATIN DE PATE AUX JAMBON',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(16306,1,1,1,0,'GREEN LABEL',0,NULL,NULL,NULL,8000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(4606,1,1,1,0,'GRENADINE',0,NULL,NULL,NULL,1500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(172,1,1,1,0,'HAMBURGER',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(21,1,1,7,0,'HEINEKEN 33 CL',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(22,1,1,7,0,'HEINEKEN 65 CL',2000,2000,100,4000,6000,10,4,20000,'BIF','simple',10,0,'oui'),(19052,1,1,1,0,'HOEGAARDEN',0,NULL,NULL,NULL,5000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(3107,1,1,1,0,'ICE SMIRNOFF',0,NULL,NULL,NULL,4000,202,0,808000,'BIF','figuratif',NULL,0,'oui'),(120,1,1,1,0,'IRISH COFFEE',0,NULL,NULL,NULL,11000,200,3,0,'BIF','figuratif',NULL,0,'oui'),(24126,1,1,1,0,'Jus de mangue',0,NULL,NULL,NULL,3000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11054,1,1,1,0,'JARDINIERE DE LEGUMES',0,NULL,NULL,NULL,5000,201,1,1005000,'BIF','figuratif',NULL,0,'oui'),(7554,1,1,1,0,'JB',0,NULL,NULL,NULL,6500,200,2,2,'BIF','figuratif',NULL,0,'oui'),(6197,1,1,1,0,'JUS COCKTAIL',0,NULL,NULL,NULL,5000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(548,1,1,1,0,'JUS D ANANAS',0,NULL,NULL,NULL,3000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(18616,1,1,1,0,'JUS D ANANAS MATIN',0,NULL,NULL,NULL,2000,206,1,412000,'BIF','figuratif',NULL,0,'oui'),(19887,1,1,1,0,'JUS D ANANAS.',0,NULL,NULL,NULL,1500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(920,1,1,1,0,'JUS D ORANGE FRAIS',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(11798,1,1,1,0,'JUS DE MANGUE',0,NULL,NULL,NULL,5000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(10,1,1,1,0,'JUS DE MANGUES FRAIS',0,NULL,NULL,NULL,4000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(921,1,1,1,0,'JUS DE PAPAYE FRAIS',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(11797,1,1,1,0,'JUS MAISON',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(2398,1,1,1,0,'JUS MARACOUJA',0,NULL,NULL,NULL,3000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11,1,1,1,0,'JUS MULTIVITAMINES FRAIS',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(13,1,1,1,0,'JUS PASSION PAPAYE FRAIS',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(18617,1,1,1,0,'JUS STAR HOTEL',0,NULL,NULL,NULL,5000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(25420,1,1,1,0,'KASSULE',0,0,NULL,0,3000,0,0,0,'BIF','figuratif',NULL,0,'oui'),(76,1,1,1,0,'KILAWIN DE CAPITAINE AU LAIT DE COCO ET CORIANDRE',0,NULL,NULL,NULL,11000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(17072,1,1,10,0,'KINJU',0,NULL,NULL,NULL,1200,198,1,237600,'BIF','figuratif',NULL,0,'oui'),(16688,1,1,10,0,'KINJU 1.5L',0,NULL,NULL,NULL,2000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(28,1,1,1,0,'KIRR',0,NULL,NULL,NULL,8500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(24125,1,1,1,0,'LAIT CHAUD',0,NULL,NULL,NULL,3000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(18615,1,1,1,0,'LAIT CHAUD MATIN',0,NULL,NULL,NULL,1500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1114,1,1,1,0,'LAIT PASTERISE',0,NULL,NULL,NULL,1500,201,2,301500,'BIF','figuratif',NULL,0,'oui'),(155,1,1,1,0,'LAN RIOJA CRIANZA,2006',0,NULL,NULL,NULL,60000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11041,1,1,1,0,'LANGUE DE VEAU AU PORTO',0,NULL,NULL,NULL,12000,202,0,2424000,'BIF','figuratif',NULL,0,'oui'),(11057,1,1,1,0,'LASAGNE BOLOGNAISE',0,NULL,NULL,NULL,12000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(11058,1,1,1,0,'LASAGNE VEGETARIENNE',0,NULL,NULL,NULL,10000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(92,1,1,1,0,'LASAGNES AUX TROIS FROMAGES',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(144,1,1,1,0,'LAURENT PERRIER GRAND SIECLE',0,NULL,NULL,NULL,500000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(23,1,1,1,0,'LEFFE BLONDE 33CL',0,NULL,NULL,NULL,7000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(24,1,1,1,0,'LEFFE BRUNE 33CL',0,NULL,NULL,NULL,7500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(11052,1,1,1,0,'LENGALENGA',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(50,1,1,1,0,'MAI TAI',0,NULL,NULL,NULL,11000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(12535,1,1,1,0,'MALIBU',0,NULL,NULL,NULL,7000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(4607,1,1,1,0,'MANDARINE NAPOLEON',0,NULL,NULL,NULL,7500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(126,1,1,1,0,'MANGUE MELBA',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(4608,1,1,1,0,'MENTHE',0,NULL,NULL,NULL,1500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(65,1,1,1,0,'MARGHARITA',0,NULL,NULL,NULL,10000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(156,1,1,1,0,'MARQUES DE RISQUAL,2004',0,NULL,NULL,NULL,83000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(29,1,1,1,0,'MARTINI BLANC',0,NULL,NULL,NULL,5000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(30,1,1,1,0,'MARTINI ROUGE',0,NULL,NULL,NULL,5000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(7831,1,1,1,0,'MERGUEZ',0,NULL,NULL,NULL,6000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(116,1,1,1,0,'MOELLEUX AU CHOCOLAT',0,NULL,NULL,NULL,14000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(142,1,1,1,0,'MOET ET CHANDON IMPERIAL',0,NULL,NULL,NULL,150000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(49,1,1,1,0,'MOJITO',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(117,1,1,1,0,'MOUSSE AU CHOCOLAT',0,NULL,NULL,NULL,6000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(2868,1,1,1,0,'MUKEKE  GRILLE',0,NULL,NULL,NULL,15000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(3348,1,1,1,0,'MUKEKE AU SAVEUR D ASIE',0,NULL,NULL,NULL,18000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11028,1,1,1,0,'MUKEKE DESOCE MENIERE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(7553,1,1,1,0,'MUKEKE DESOSSE',0,NULL,NULL,NULL,16000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(12538,1,1,1,0,'MUZUZU',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(18621,1,1,1,0,'OEUF SUR PLAT TOURNE MATIN',0,NULL,NULL,NULL,2500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(18622,1,1,1,0,'OMELETTE AU CHAMPIGNONS MATIN',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(18624,1,1,1,0,'OMELETTE AUGUSTIN',0,NULL,NULL,NULL,4500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(365,1,1,1,0,'OMELETTE FROMAGE',0,NULL,NULL,NULL,3000,200,3,0,'BIF','figuratif',NULL,0,'oui'),(546,1,1,1,0,'OMELETTE JAMBON',0,NULL,NULL,NULL,3500,199,2,696500,'BIF','figuratif',NULL,0,'oui'),(364,1,1,1,0,'OMELETTE JAMBON ,TOMATE,OIGNONS',0,NULL,NULL,NULL,6000,199,2,1194000,'BIF','figuratif',NULL,0,'oui'),(28070,1,1,1,NULL,'Buffet/30Personne',0,NULL,NULL,NULL,18000,200,1,3600000,'BIF','figuratif',NULL,0,'oui'),(18625,1,1,1,0,'OMELETTE JAMBON FROMAGE MATIN',0,0,NULL,0,3500,0,1,0,'BIF','figuratif',NULL,0,'oui'),(18628,1,1,1,0,'OMELETTE JAMBON OIGNON MATIN',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(18626,1,1,1,0,'OMELETTE JAMBON TOMATES',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(2399,1,1,1,0,'OMELETTE OIGNON',0,NULL,NULL,NULL,3000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(18623,1,1,1,0,'OMELETTE OIGNON JAMBON CHAMPIGNONS',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1741,1,1,1,0,'OMELETTE SPECIAL',0,NULL,NULL,NULL,5000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(10104,1,1,1,0,'OMELETTE STAR HOTEL',0,0,NULL,0,6000,0,0,0,'BIF','figuratif',NULL,0,'oui'),(18629,1,1,1,0,'OMELETTE STAR HOTEL MATIN',0,0,NULL,0,5000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(18627,1,1,1,0,'OMELETTE TOMATES',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(5657,1,1,1,0,'omelette tomatte',0,NULL,NULL,NULL,3000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(8112,1,1,1,0,'OMELLETTE CHAMPIGNON',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(3840,1,1,1,0,'OMELLETTE NATURE',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(26285,1,1,1,0,'OMOLETTE ESPAGNOLE',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1526,1,1,1,0,'OMOLETTE FROMAGE',0,NULL,NULL,NULL,3000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1525,1,1,1,0,'OMOLETTE STAR HOTEL',0,NULL,NULL,NULL,6000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(16689,1,1,1,0,'PAIN PERDU',0,0,NULL,0,3000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(171,1,1,1,0,'PAN BAGNAT',0,0,NULL,0,9000,0,2,0,'BIF','figuratif',NULL,0,'oui'),(11061,1,1,1,0,'PANACHE DE GLASSE',0,NULL,NULL,NULL,6000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(178,1,1,1,0,'PANINI TOMATE MOZZARELLA BASILIC',0,0,NULL,0,10000,0,2,0,'BIF','figuratif',NULL,0,'oui'),(180,1,1,1,0,'PANINI TOMATE MOZZARELLA BASILIC JAMBON CRU',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(179,1,1,1,0,'PANINI TOMATE MOZZARELLA BASILIC THON',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(181,1,5,12,0,'PANINI TOMATE MOZZARELLA POULET AU CURRY',0,NULL,NULL,NULL,13000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(1961,1,1,1,0,'par maison',0,NULL,NULL,NULL,3000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(20308,1,1,1,0,'PATISSERIE MAISON ',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(19469,1,1,1,0,'PATTE DE MANIOC',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(88,1,1,1,0,'PENNE AGLIO E OLIO',0,NULL,NULL,NULL,9000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(87,1,1,1,0,'PENNE PUTANESCA',0,NULL,NULL,NULL,14000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(6195,1,1,1,0,'PETIT DEJEUNER',0,NULL,NULL,NULL,10000,214,0,2140000,'BIF','figuratif',NULL,0,'oui'),(11053,1,1,1,0,'PETIT POIDS',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(81,1,1,1,0,'PETITE FRITURE DU LAC TANGANYIKA',0,NULL,NULL,NULL,9000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(47,1,1,1,0,'PINACOLADA',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(39,1,1,1,0,'PINK LADY',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(57,1,1,1,0,'PINK SWEET',0,NULL,NULL,NULL,10000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(175,1,1,1,0,'PISSALADIERE',0,NULL,NULL,NULL,9500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(106,1,1,1,0,'PIZZA 4  FROMAGES',0,NULL,NULL,NULL,17000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(108,1,1,1,0,'PIZZA ALPAGE',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(110,1,1,1,0,'PIZZA CALZONE',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(112,1,1,1,0,'PIZZA CREOLE',0,NULL,NULL,NULL,18000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(3351,1,1,1,0,'PIZZA ESPAGNOL',0,NULL,NULL,NULL,13000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(107,1,1,1,0,'PIZZA LA MER',0,NULL,NULL,NULL,16000,200,2,3200000,'BIF','figuratif',NULL,0,'oui'),(21573,1,1,1,0,'PIZZA MAFIOZO',0,NULL,NULL,NULL,13000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(99,1,1,1,0,'PIZZA MARGUERITE',0,NULL,NULL,NULL,11000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(104,1,1,1,0,'PIZZA NAPOLITAINE',0,NULL,NULL,NULL,15000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(103,1,1,1,0,'PIZZA NICOISE',0,NULL,NULL,NULL,14000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(109,1,1,1,0,'PIZZA NORVEGIENNE',0,NULL,NULL,NULL,19000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(100,1,1,1,0,'PIZZA REINE',0,NULL,NULL,NULL,12000,201,2,2412000,'BIF','figuratif',NULL,0,'oui'),(101,1,1,1,0,'PIZZA ROMANA',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(105,1,1,1,0,'PIZZA SOLEIL',0,NULL,NULL,NULL,18000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(111,1,1,1,0,'PIZZA SUCRE SALEE',0,NULL,NULL,NULL,18000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(113,1,1,1,0,'PIZZA VEGETARIENNE',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(10107,1,1,1,0,'PLAT SIMPLE',0,NULL,NULL,NULL,5000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(60,1,1,1,0,'PLEASE LOVE ME',0,NULL,NULL,NULL,12000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11055,1,1,1,0,'POMME NATURE',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(1120,1,1,1,0,'PORTION DE FRITE',0,NULL,NULL,NULL,4000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(2404,1,1,1,0,'PORTION FROMAGE',0,NULL,NULL,NULL,4000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(7833,1,1,1,0,'PORTION HARCOT VERT',0,NULL,NULL,NULL,5000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(27588,1,1,1,0,'PORTION JAMBEAU',0,NULL,NULL,NULL,4000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(10407,1,1,1,0,'PORTION JARDINIERE DE LEGUME',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(9236,1,1,1,0,'PORTION LEGUME',0,NULL,NULL,NULL,5000,199,0,995000,'BIF','figuratif',NULL,0,'oui'),(11796,1,1,1,0,'PORTION MUZUZU',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(15548,1,1,1,0,'PORTION PETIT POIDS',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(19466,1,1,1,0,'PORTION POMME NATURE',0,NULL,NULL,NULL,3000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(5392,1,1,1,0,'PORTION RIZ',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(2405,1,1,1,0,'PORTION SAMBUSSA',0,NULL,NULL,NULL,3500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(19467,1,1,1,0,'PORTION SAUSSICON',0,NULL,NULL,NULL,3000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(35,1,1,1,0,'PORTO ROUGE OU BLANC',0,NULL,NULL,NULL,6000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(6196,1,1,1,0,'POTAGE',0,NULL,NULL,NULL,3000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(136,1,1,1,0,'POUILLY FUISSE,PASCAL  CLEMENT,2009',0,NULL,NULL,NULL,105000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11013,1,1,1,0,'POUILLY FUME DOMAINE DES CASSIERS 2009',0,NULL,NULL,NULL,100000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(138,1,1,1,0,'POUILLY FUME,DOMAINE DES CASSIERS,2009',0,NULL,NULL,NULL,100000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11048,1,5,12,0,'POULET BOCAGE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(1116,1,5,12,0,'POULET ENTIER',0,NULL,NULL,NULL,40000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(2402,1,1,1,0,'POURBOIRE DU 25/10/2011',0,NULL,NULL,NULL,3500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(28169,1,1,10,NULL,'RAMBA 1L',500,345,100,690,1000,32,4,11049.96,'BIF','simple',5,0,'oui'),(102,1,1,1,0,'PZZA ESPAGNOLE',0,NULL,NULL,NULL,13000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(174,1,1,1,0,'QUICHE LORRAINE',0,NULL,NULL,NULL,9500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11044,1,1,1,0,'RAGOUT DE CHEVRE',0,NULL,NULL,NULL,10000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(7,1,1,1,0,'RED BULL',0,NULL,NULL,NULL,4000,198,0,792000,'BIF','figuratif',NULL,0,'oui'),(3594,1,1,1,0,'RED LABEL',0,NULL,NULL,NULL,5500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(44,1,1,1,0,'RHUM COCA',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(32,1,1,1,0,'RICARD',0,NULL,NULL,NULL,6000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(31,1,1,1,0,'RICARD TOMATE OU PEROQUET',0,NULL,NULL,NULL,7000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(91,1,1,1,0,'RIGATONI AL PESTO',0,NULL,NULL,NULL,9000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11043,1,1,1,0,'ROGNON A LA DIDJONAISE',0,NULL,NULL,NULL,10000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11042,1,1,1,0,'ROGNON FACON BOUGE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11019,1,1,1,0,'ROULADE  DE LEGUME GRATINE',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(72,1,1,1,0,'SALADE CESAR',0,NULL,NULL,NULL,11000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(67,1,1,1,0,'SALADE DE CHEVRE CHAUD,JAMBON CRU ET POILEE DE CHAMPIGNON',0,NULL,NULL,NULL,14500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(361,1,1,1,0,'SALADE DE FRUIT',0,NULL,NULL,NULL,4000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(2397,1,1,1,0,'SALADE DE FRUIT MATIN',0,NULL,NULL,NULL,3000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(18631,1,5,12,0,'SALADE DE POULET MATIN',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(10405,1,1,1,0,'SALADE DU CHEF',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(71,1,1,1,0,'SALADE DU CROCO',0,NULL,NULL,NULL,9000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(70,1,1,1,0,'SALADE FRAICHEUR',0,NULL,NULL,NULL,7000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(9814,1,1,1,0,'SALADE MIXTE',0,NULL,NULL,NULL,4000,201,1,804000,'BIF','figuratif',NULL,0,'oui'),(18632,1,1,1,0,'SALADE MIXTE MATIN',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(66,1,1,1,0,'SALADE NICOISE',0,NULL,NULL,NULL,8000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(73,1,1,1,0,'SALADE NORDIQUE',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(10923,1,1,1,0,'SALADE STAR HOTEL',0,NULL,NULL,NULL,8000,200,2,2,'BIF','figuratif',NULL,0,'oui'),(18630,1,1,1,0,'SALADE STAR HOTEL MATIN',0,NULL,NULL,NULL,5000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11012,1,1,1,0,'SANCERRE MANOIR DU FORT 2009',0,NULL,NULL,NULL,100000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(137,1,1,1,0,'SANCERRE,MANOIR DU FORT,2009',0,NULL,NULL,NULL,100000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(28121,1,1,1,NULL,'TRANCHE D ANANAS',0,NULL,NULL,NULL,1000,200,1,400000,'BIF','figuratif',10,0,'oui'),(10103,1,1,1,0,'SANDWICH AU THON',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(360,1,1,1,0,'SANDWICH FROMAGE',0,NULL,NULL,NULL,1500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(914,1,1,1,0,'SANDWICH JAMBON',0,NULL,NULL,NULL,1500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(27918,1,1,1,0,'SANDWICH JAMBON FROMAGE',0,NULL,NULL,NULL,2000,200,2,0,'BIF','figuratif',NULL,0,'oui'),(182,1,1,1,0,'SANDWICH NORDIQUE',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(363,1,1,1,0,'SANDWICH OMELETTE',0,NULL,NULL,NULL,1500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(10105,1,5,12,0,'SANDWICH POULET JAMBON',0,NULL,NULL,NULL,2500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(173,1,1,1,0,'SANDWICH RILLETTES OU JAMBON BLANC OU SALAMI',0,NULL,NULL,NULL,7000,199,2,1393000,'BIF','figuratif',NULL,0,'oui'),(3841,1,1,1,0,'SANDWICH VIDE',0,NULL,NULL,NULL,700,212,1,106000,'BIF','figuratif',NULL,0,'oui'),(11026,1,1,1,0,'SANGALA AUX PETIT LEGUMES',0,NULL,NULL,NULL,15000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(2869,1,1,1,0,'SANGALA AUX SAVEUR DÂ°ASIE',0,NULL,NULL,NULL,18000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11027,1,1,1,0,'SANGALA BONNE FEMME',0,NULL,NULL,NULL,15000,198,2,2970000,'BIF','figuratif',NULL,0,'oui'),(1119,1,1,1,0,'SANGALA CHAMPIGNON ',0,NULL,NULL,NULL,15000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11022,1,1,1,0,'SANGALA CHAMPIGNON CREME',0,NULL,NULL,NULL,15000,201,1,3015000,'BIF','figuratif',NULL,0,'oui'),(7555,1,1,1,0,'SANGALA GRATINE',0,NULL,NULL,NULL,15000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(4605,1,1,1,0,'SANGALA GRATINE AUX EPINARD',0,NULL,NULL,NULL,15000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11023,1,1,1,0,'SANGALA GRATINE AUX PORTO',0,NULL,NULL,NULL,15000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(10401,1,1,1,0,'SANGALA GRATINES AUX OIGNONS',0,NULL,NULL,NULL,17000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(5927,1,1,1,0,'SANGALA GRILLE A L;ail',0,NULL,NULL,NULL,15000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1117,1,1,1,0,'SANGALA MEUNIERE',0,NULL,NULL,NULL,13000,200,2,2600000,'BIF','figuratif',NULL,0,'oui'),(9239,1,1,1,0,'SANGALA PROVENCALE',0,NULL,NULL,NULL,15000,203,1,3045000,'BIF','figuratif',NULL,0,'oui'),(11024,1,1,1,0,'SANGALA STAR HOTEL',0,NULL,NULL,NULL,18000,202,1,3636000,'BIF','figuratif',NULL,0,'oui'),(11025,1,1,1,0,'SANGALA VOIVRE VERT CREME',0,NULL,NULL,NULL,16000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(14036,1,1,1,0,'SAUCE CHAMPIGNON CREME',0,NULL,NULL,NULL,3000,201,2,603000,'BIF','figuratif',NULL,0,'oui'),(19468,1,1,1,0,'SAUCE PROVENCAL',0,NULL,NULL,NULL,3500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(10106,1,1,1,0,'SAUCE PROVINCALE',0,NULL,NULL,NULL,4000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11046,1,1,1,0,'SAUTE DE VOLAILLES AUX GINGEMBRE',0,NULL,NULL,NULL,12000,200,2,2,'BIF','figuratif',NULL,0,'oui'),(11015,1,1,1,0,'SCAMPIS AUX BEURRE D.AIL',0,NULL,NULL,NULL,7000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(18,1,1,1,0,'SERENGETI',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(17074,1,1,1,0,'SERVICE DANS LES CHAMBRES',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(11431,1,1,1,0,'SEX BOYS',0,NULL,NULL,NULL,8000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(11067,1,1,1,0,'SEX ON THE BEACH',0,NULL,NULL,NULL,8000,199,1,1592000,'BIF','figuratif',NULL,0,'oui'),(27,1,1,1,0,'SKOL 65 CL',0,NULL,NULL,NULL,3500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(10709,1,5,12,0,'SOUPE  DE POULET',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(2396,1,1,1,0,'SOUPE AUX EPINARD',0,NULL,NULL,NULL,4500,200,2,1,'BIF','figuratif',NULL,0,'oui'),(545,1,1,1,0,'SOUPE AUX LEGUMES',0,NULL,NULL,NULL,4000,199,2,796000,'BIF','figuratif',NULL,0,'oui'),(9526,1,1,1,0,'SOUPE AUX POISSONS',0,NULL,NULL,NULL,6000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(27585,1,1,1,0,'SOUPE CHAMPIGNON',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(18618,1,1,1,0,'SOUPE DE LEGUME MATIN',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(18619,1,1,1,0,'SOUPE DE POISSON MATIN',0,NULL,NULL,NULL,3500,200,1,1,'BIF','figuratif',NULL,0,'oui'),(27956,1,1,1,0,'SOUPE DE VOLAILLE',0,NULL,NULL,NULL,3500,200,1,0,'BIF','figuratif',NULL,0,'oui'),(11020,1,1,1,0,'SOUPE ITALIENNE',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(10708,1,5,12,0,'SOUPER DE POULET',0,NULL,NULL,NULL,7000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(916,1,1,1,0,'SOURIS D AGNEAU',0,NULL,NULL,NULL,22000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(9237,1,1,1,0,'SPAGHETTI  VEGETARIENNE',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(83,1,1,1,0,'SPAGHETTI A LA BOLOGNAISE',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(82,1,1,1,0,'SPAGHETTI A LA CARBONARA ',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(11059,1,1,1,0,'SPAGHETTI AUX PETIT LEGUMES',0,NULL,NULL,NULL,14000,200,0,2,'BIF','figuratif',NULL,0,'oui'),(84,1,1,1,0,'SPAGHETTI DU CHARRETIER',0,NULL,NULL,NULL,14000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(6,1,1,7,0,'SPRITE',0,NULL,NULL,NULL,1200,202,0,242400,'BIF','figuratif',NULL,0,'oui'),(11056,1,1,1,0,'SUPLEMMENT FECULANT',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(43,1,1,1,0,'SWEET MARTINI',0,NULL,NULL,NULL,11000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(154,1,1,1,0,'SYRAH TARRAGONA,2008',0,NULL,NULL,NULL,33000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(90,1,1,1,0,'TAGLIATELLE RICOTTA ET AMANDES',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(89,1,1,1,0,'TAGLIATELLE VEGETARIENNE',0,NULL,NULL,NULL,10000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(10403,1,1,1,0,'TAPAS 4 CHOIX',0,NULL,NULL,NULL,8000,200,1,1600000,'BIF','figuratif',NULL,0,'oui'),(12536,1,1,1,0,'TAPAS DEUX CHOIX',0,NULL,NULL,NULL,5000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(78,1,1,1,0,'TARTARE DE BOEUF CAMPAGNARD',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(74,1,1,1,0,'TARTARE DE POISSON A LA CORIANDRE',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(118,1,1,1,0,'TARTE CITRON A MA FACON',0,NULL,NULL,NULL,8000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(75,1,1,1,0,'TARTE DE SAINT JACQUES, MANGUE ET PASSION',0,NULL,NULL,NULL,16000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(62,1,1,1,0,'TEQUILA SUNRISE',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(184,1,1,1,0,'TEQUILLA',0,NULL,NULL,NULL,7000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(28028,1,1,1,NULL,'TESE',0,NULL,NULL,NULL,10000,1,1,10000,'BIF','figuratif',NULL,0,'oui'),(64,1,1,1,0,'TGV',0,NULL,NULL,NULL,9000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(2867,1,1,1,0,'THE',0,NULL,NULL,NULL,2500,201,0,502500,'BIF','figuratif',NULL,0,'oui'),(28025,1,1,1,0,'THE AFRICAIN',0,NULL,NULL,NULL,3000,199,0,597000,'BIF','figuratif',NULL,0,'oui'),(18612,1,1,1,0,'THE AU CITRON',0,NULL,NULL,NULL,2000,201,1,402000,'BIF','figuratif',NULL,0,'oui'),(11433,1,1,1,0,'THE AU GINGEMBRE',0,NULL,NULL,NULL,2500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(27983,1,1,1,0,'THE AU MIEL MATIN',0,NULL,NULL,NULL,2000,200,0,0,'BIF','figuratif',NULL,0,'oui'),(28029,1,1,1,NULL,'THE AU MIEL SOIR',0,NULL,NULL,NULL,2500,1,4,3000,'BIF','figuratif',NULL,0,'oui'),(2403,1,1,1,0,'THE CITRONNE AU GINGEMBRE',0,NULL,NULL,NULL,3000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(366,1,1,1,0,'THE ET INFUSION',0,NULL,NULL,NULL,2500,200,3,0,'BIF','figuratif',NULL,0,'oui'),(9,1,1,1,0,'THE GLACE  MAISON',0,NULL,NULL,NULL,1800,200,3,0,'BIF','figuratif',NULL,0,'oui'),(3109,1,1,1,0,'THE GLACE MAISON',0,NULL,NULL,NULL,1800,200,2,1,'BIF','figuratif',NULL,0,'oui'),(18609,1,1,1,0,'THE MATIN',0,NULL,NULL,NULL,1500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(362,1,1,1,0,'THE RUSSE',0,NULL,NULL,NULL,3000,199,3,597000,'BIF','figuratif',NULL,0,'oui'),(18611,1,1,1,0,'THE RUSSE MATIN',0,NULL,NULL,NULL,2000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(3845,1,1,1,0,'TIA MARIA',0,NULL,NULL,NULL,7000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(61,1,1,1,0,'TINA',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(121,1,1,1,0,'TIRAMISU',0,NULL,NULL,NULL,12000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(27586,1,1,1,0,'TOASTS AU THON',0,NULL,NULL,NULL,4000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(22421,1,1,1,0,'TOMATE GRILLE ',0,NULL,NULL,NULL,500,200,0,2,'BIF','figuratif',NULL,0,'oui'),(68,1,1,1,0,'TOMATE MOZZARELLA DI BUFFARA',0,NULL,NULL,NULL,25000,200,2,1,'BIF','figuratif',NULL,0,'oui'),(8,1,1,7,0,'TONIC',0,NULL,NULL,NULL,1200,198,0,237600,'BIF','figuratif',NULL,0,'oui'),(12534,1,1,1,0,'TRANCHE DE MANGUE',0,NULL,NULL,NULL,1000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(14791,1,1,1,0,'TRANCHE DE PAPAYE',0,NULL,NULL,NULL,1000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(4609,1,1,1,0,'TRILOGIE DE  DE CORNET SAVEUR',0,NULL,NULL,NULL,9000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(3842,1,1,1,0,'TUSKER',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(20,1,1,1,0,'TUSKER  MALT',0,NULL,NULL,NULL,4000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(19,1,1,1,0,'TUSKER LAGER',0,NULL,NULL,NULL,3500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(14413,1,1,1,0,'UBUGARI',0,NULL,NULL,NULL,3000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(8394,1,1,1,0,'VERRE DE LAIT PASTER',0,NULL,NULL,NULL,1500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(37,1,1,9,0,'VERRE DE VIN BLANC',0,NULL,NULL,NULL,6000,200,1,1200000,'BIF','figuratif',NULL,0,'oui'),(36,1,1,9,0,'VERRE DE VIN ROUGE',0,NULL,NULL,NULL,6000,199,1,1194000,'BIF','figuratif',NULL,0,'oui'),(2400,1,1,1,0,'VERSEMENT DU 25/10/2011',0,NULL,NULL,NULL,131600,200,2,1,'BIF','figuratif',NULL,0,'oui'),(141,1,1,1,0,'VEUVE CLIQUOT',0,NULL,NULL,NULL,160000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(1530,1,1,7,0,'SCHWEPSS',0,NULL,NULL,NULL,1200,200,0,1,'BIF','figuratif',NULL,0,'oui'),(7280,1,1,1,0,'VODKA',0,NULL,NULL,NULL,6500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(52,1,1,1,0,'VODKA TONIC',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11049,1,1,1,0,'VOL AUX VENT',0,NULL,NULL,NULL,12000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(56,1,1,1,0,'WHISKY COCA',0,NULL,NULL,NULL,8000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(59,1,1,1,0,'WHISKY SOUR',0,NULL,NULL,NULL,11000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(5658,1,1,1,0,'YAOURT',0,NULL,NULL,NULL,1500,200,0,1,'BIF','figuratif',NULL,0,'oui'),(21149,1,1,1,0,'ZILENKEN ELIBRING CLASSIC',0,NULL,NULL,NULL,30000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(146,1,1,1,0,'ZILLIKEN DORNFELDER',0,NULL,NULL,NULL,60000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(11432,1,1,1,0,'ZILLIKEN DORRFELDER',0,NULL,NULL,NULL,45000,200,0,1,'BIF','figuratif',NULL,0,'oui'),(139,1,1,1,0,'ZILLIKEN ELBLING  ROSE',0,NULL,NULL,NULL,42000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(131,1,1,1,0,'ZILLIKEN ELBLING CLASSIC SEEC',0,NULL,NULL,NULL,48000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(132,1,1,1,0,'ZILLIKEN ELBLING FILLIUS DEMIS- SEC',0,NULL,NULL,NULL,51000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(135,1,1,1,0,'ZILLIKEN KERNER',0,NULL,NULL,NULL,65000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(140,1,1,1,0,'ZILLIKEN METHODE CHAMPENOISE',0,NULL,NULL,NULL,70000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(147,1,1,1,0,'ZILLIKEN PINOT NOIR ,FUT DE CHENE',0,NULL,NULL,NULL,91000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(133,1,1,1,0,'ZILLIKEN RIESLING KABINETT  DEMI-SEC',0,NULL,NULL,NULL,42000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(134,1,1,1,0,'ZILLIKEN RIESLING VIELLES VIGNES',0,NULL,NULL,NULL,75000,200,1,1,'BIF','figuratif',NULL,0,'oui'),(24988,1,1,1,0,'ZILLIKEN ROTER ELBLING',0,NULL,NULL,NULL,42000,200,1,2,'BIF','figuratif',NULL,0,'oui'),(28048,1,1,1,NULL,'COCKTAIL MAISON',0,NULL,NULL,NULL,9000,199,1,1791000,'BIF','figuratif',NULL,0,'oui'),(28049,1,1,1,NULL,'AMARETO',0,0,NULL,0,6000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(28050,1,1,1,NULL,'POULET ENTIER',0,NULL,NULL,NULL,40000,200,1,100000,'BIF','figuratif',NULL,0,'oui'),(28052,1,1,1,NULL,'cocktail star hotel',0,NULL,NULL,NULL,9000,200,1,1800000,'BIF','figuratif',NULL,0,'oui'),(28056,1,1,1,NULL,'melot',0,NULL,NULL,NULL,1000,200,1,200000,'BIF','figuratif',NULL,0,'oui'),(28057,1,1,1,NULL,'SERVICE CHAMBRE',0,NULL,NULL,NULL,5000,200,1,1000000,'BIF','figuratif',NULL,0,'oui'),(28058,1,1,1,NULL,'SAUCISSE ',0,NULL,NULL,NULL,8000,200,1,1600000,'BIF','figuratif',NULL,0,'oui'),(28059,1,1,1,NULL,'salade exotic',0,NULL,NULL,NULL,5000,200,1,1000000,'BIF','figuratif',NULL,0,'oui'),(28060,1,1,1,NULL,'portion gateau',0,NULL,NULL,NULL,3000,200,1,600000,'BIF','figuratif',NULL,0,'oui'),(28061,1,1,1,NULL,'CRIOSSANT FROMAGE',0,NULL,NULL,NULL,2000,200,1,400000,'BIF','figuratif',NULL,0,'oui'),(28062,1,1,1,NULL,'OMOLETTE NATURE',0,NULL,NULL,NULL,2500,200,1,500000,'BIF','figuratif',NULL,0,'oui'),(28063,1,1,1,NULL,'ARNAUD ST EST',0,NULL,NULL,NULL,150000,200,1,30000000,'BIF','figuratif',NULL,0,'oui'),(28064,1,1,1,NULL,'ELBLING FILIUS',0,NULL,NULL,NULL,40000,200,1,8000000,'BIF','figuratif',NULL,0,'oui'),(28065,1,1,1,NULL,'GATEAU',0,NULL,NULL,NULL,30000,200,1,6000000,'BIF','figuratif',NULL,0,'oui'),(28066,1,1,1,NULL,'EL DIABLE',0,NULL,NULL,NULL,8000,200,1,1600000,'BIF','figuratif',NULL,0,'oui'),(28067,1,1,1,NULL,'CAFE EXPRESSO',0,NULL,NULL,NULL,1500,200,1,600000,'BIF','figuratif',NULL,0,'oui'),(28068,1,1,1,NULL,'SALADE D AVOCAT',0,NULL,NULL,NULL,4000,200,1,800000,'BIF','figuratif',NULL,0,'oui'),(28069,1,1,1,NULL,'SALADE OIGNON',0,NULL,NULL,NULL,2000,200,1,400000,'BIF','figuratif',NULL,0,'oui'),(28071,1,1,1,NULL,'Cockaitl/30Personne',0,NULL,NULL,NULL,9000,200,1,1800000,'BIF','figuratif',NULL,0,'oui'),(28072,1,1,1,NULL,'Pause cafe/30Personne',0,NULL,NULL,NULL,6500,200,1,1300000,'BIF','figuratif',NULL,0,'oui'),(28073,1,1,1,NULL,'Cocktail/30Personne',0,NULL,NULL,NULL,9000,200,1,1800000,'BIF','figuratif',NULL,0,'oui'),(28074,1,1,1,NULL,'buffet special',0,NULL,NULL,NULL,20000,200,1,4000000,'BIF','figuratif',NULL,0,'oui'),(28075,1,1,1,NULL,'buffet enfant',0,NULL,NULL,NULL,10000,200,1,2000000,'BIF','figuratif',NULL,0,'oui'),(28076,1,1,1,NULL,'creme glace',0,NULL,NULL,NULL,1500,200,1,300000,'BIF','figuratif',NULL,0,'oui'),(28077,1,1,1,NULL,'Buffet',0,NULL,NULL,NULL,15000,200,1,3000000,'BIF','figuratif',NULL,0,'oui'),(28078,1,1,1,NULL,'Buffet;',0,NULL,NULL,NULL,17000,200,1,2600000,'BIF','figuratif',NULL,0,'oui'),(28079,1,1,1,NULL,'BOUTEILLE AMARULA',0,NULL,NULL,NULL,60000,200,1,12000000,'BIF','figuratif',NULL,0,'oui'),(28080,1,1,1,NULL,'croissant  jambon',0,NULL,NULL,NULL,2000,200,1,500000,'BIF','figuratif',NULL,0,'oui'),(28081,1,1,1,NULL,'SANDUICH CONTINANTAL',0,NULL,NULL,NULL,3000,200,1,600000,'BIF','figuratif',NULL,0,'oui'),(28082,1,1,10,NULL,'Aquavie petillante 350ml',0,NULL,NULL,NULL,1000,200,1,200000,'BIF','figuratif',NULL,0,'oui'),(28083,1,1,1,NULL,'SAUCISSE GARNI',0,NULL,NULL,NULL,12000,200,1,2400000,'BIF','figuratif',NULL,0,'oui'),(28084,1,1,1,NULL,'0molette frite',0,0,NULL,0,3000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(28085,1,1,9,NULL,'VERRE DE VIN ROUGE DROSTY',0,0,NULL,0,5000,0,1,0,'BIF','figuratif',NULL,0,'oui'),(28086,1,1,1,NULL,'buffet per',0,NULL,NULL,NULL,17000,200,1,3400000,'BIF','figuratif',NULL,0,'oui'),(28087,1,1,1,NULL,'baro d\'argnac',0,NULL,NULL,NULL,10000,200,1,2000000,'BIF','figuratif',NULL,0,'oui'),(28088,1,1,1,NULL,'B52',0,NULL,NULL,NULL,8000,200,1,1600000,'BIF','figuratif',NULL,0,'oui'),(28089,1,1,1,NULL,'SANDWICH CLUB',0,NULL,NULL,NULL,3500,200,1,700000,'BIF','figuratif',NULL,0,'oui'),(28090,1,1,1,NULL,'PORTION MERGEZ',0,NULL,NULL,NULL,4000,200,1,800000,'BIF','figuratif',10,0,'oui'),(28091,1,1,1,NULL,'cote de porc a ma facon',0,NULL,NULL,NULL,10000,200,1,2000000,'BIF','figuratif',10,0,'oui'),(28092,1,5,12,NULL,'SANDWICH AU POULET',0,NULL,NULL,NULL,3000,200,1,500000,'BIF','figuratif',10,0,'oui'),(28093,4,4,6,NULL,'leo-1000',1000,NULL,NULL,NULL,1000,0,4,0,'BIF','figuratif',0,0,'oui'),(28094,1,1,1,NULL,'pizza sp',0,NULL,NULL,NULL,8000,200,1,1600000,'BIF','figuratif',10,0,'oui'),(28095,1,1,1,NULL,'droit de bouchon liqueur',0,NULL,NULL,NULL,10000,200,1,2000000,'BIF','figuratif',10,0,'oui'),(28096,4,4,6,NULL,'leo-5000',5000,NULL,NULL,NULL,5000,10,4,50000,'BIF','figuratif',0,0,'oui'),(28097,4,4,6,NULL,'leo-10000',10000,NULL,NULL,NULL,10000,0,4,0,'BIF','figuratif',0,0,'oui'),(28098,4,4,6,NULL,'leo-2000',2000,NULL,NULL,NULL,2000,16,4,32000,'BIF','figuratif',0,0,'oui'),(28099,4,4,6,NULL,'tempo-sim',1000,NULL,NULL,NULL,1000,19,4,19000,'BIF','figuratif',0,0,'oui'),(28100,4,4,6,NULL,'tempo-10000',10000,NULL,NULL,NULL,10000,11,4,110000,'BIF','figuratif',0,0,'oui'),(28101,4,4,6,NULL,'tempo-5000',5000,NULL,NULL,NULL,5000,9,4,45000,'BIF','figuratif',0,0,'oui'),(28102,4,4,6,NULL,'tempo-3000',3000,NULL,NULL,NULL,3000,9,4,27000,'BIF','figuratif',0,0,'oui'),(28103,4,4,6,NULL,'tempo-1000',1000,NULL,NULL,NULL,1000,0,4,0,'BIF','figuratif',0,0,'oui'),(28104,4,4,6,NULL,'smart-10000',10000,NULL,NULL,NULL,10000,3,4,30000,'BIF','figuratif',0,0,'oui'),(28105,4,4,6,NULL,'smart-5000',5000,NULL,NULL,NULL,5000,5,4,25000,'BIF','figuratif',0,0,'oui'),(28106,4,4,6,NULL,'smart-2000',2000,NULL,NULL,NULL,2000,10,4,20000,'BIF','figuratif',0,0,'oui'),(28107,4,4,6,NULL,'smart-1000',1000,NULL,NULL,NULL,1000,15,4,15000,'BIF','figuratif',0,0,'oui'),(28108,4,4,6,NULL,'onamob-10000',10000,NULL,NULL,NULL,10000,12,4,120000,'BIF','figuratif',0,0,'oui'),(28109,4,4,6,NULL,'onamob-5000',5000,NULL,NULL,NULL,5000,5,4,25000,'BIF','figuratif',0,0,'oui'),(28110,4,4,6,NULL,'onamob-2000',2000,NULL,NULL,NULL,2000,10,4,20000,'BIF','figuratif',0,0,'oui'),(28111,4,4,6,NULL,'onamob-1000',1000,NULL,NULL,NULL,1000,4,4,4000,'BIF','figuratif',0,0,'oui'),(28112,4,4,6,NULL,'econet-10000',10000,NULL,NULL,NULL,10000,5,4,50000,'BIF','figuratif',0,0,'oui'),(28113,4,4,6,NULL,'econet-5000',5000,NULL,NULL,NULL,5000,6,4,30000,'BIF','figuratif',0,0,'oui'),(28114,4,4,6,NULL,'econet-2000',2000,NULL,NULL,NULL,2000,12,4,24000,'BIF','figuratif',0,0,'oui'),(28115,4,4,6,NULL,'econet-1000',1000,NULL,NULL,NULL,1000,0,4,0,'BIF','figuratif',0,0,'oui'),(28116,1,1,1,NULL,'POMME  SAUTE',0,NULL,NULL,NULL,4000,200,1,800000,'BIF','figuratif',10,0,'oui'),(28117,1,1,1,NULL,'CROSSANT OMOLETTE',0,NULL,NULL,NULL,1500,200,1,300000,'BIF','figuratif',10,0,'oui'),(28118,1,1,1,NULL,'DROIT DE BOUCHON',0,NULL,NULL,NULL,5000,200,1,1000000,'BIF','figuratif',10,0,'oui'),(28119,1,1,1,NULL,'TAPAS SPECIAL ',0,NULL,NULL,NULL,12000,200,1,2400000,'BIF','figuratif',10,0,'oui'),(28120,1,1,1,NULL,'SANDWICH AVOCAT',0,NULL,NULL,NULL,2000,200,1,400000,'BIF','figuratif',10,0,'oui'),(28122,4,4,6,NULL,'leo 10000',10000,NULL,NULL,NULL,10000,10,4,100000,'BIF','figuratif',0,0,'oui'),(28123,4,4,6,NULL,'lÃ©o 1000',1000,NULL,NULL,NULL,1000,30,4,30000,'BIF','figuratif',0,0,'oui'),(28124,4,4,6,NULL,'africell-1000',1000,NULL,NULL,NULL,1000,2,4,2000,'BIF','figuratif',0,0,'oui'),(28125,1,1,1,NULL,'EBLING  TROKEN',0,NULL,NULL,NULL,42000,200,1,8400000,'BIF','figuratif',10,0,'oui'),(28126,1,1,1,NULL,'EAU CITRONNE',0,NULL,NULL,NULL,500,200,1,100000,'BIF','figuratif',10,0,'oui'),(28127,4,4,6,NULL,'TEMPO 10000',10000,NULL,NULL,NULL,10000,5,4,50000,'BIF','figuratif',0,0,'oui'),(28128,4,4,6,NULL,'ECONET2000',2000,NULL,NULL,NULL,2000,10,4,20000,'BIF','figuratif',0,0,'oui'),(28129,4,4,6,NULL,'ECONET 1000',1000,NULL,NULL,NULL,1000,20,4,20000,'BIF','figuratif',0,0,'oui'),(28130,4,4,6,NULL,'ONAMOB5000',5000,NULL,NULL,NULL,5000,3,4,15000,'BIF','figuratif',0,0,'oui'),(28131,1,1,1,NULL,'assiette de canapÃ©s',0,NULL,NULL,NULL,4000,200,1,800000,'BIF','figuratif',10,0,'oui'),(28132,1,1,1,NULL,'TAPAS & SEUL CHOIX',0,NULL,NULL,NULL,3500,200,1,700000,'BIF','figuratif',10,0,'oui'),(28133,1,1,7,NULL,'coca cola 1l',0,NULL,NULL,NULL,5000,1,4,5000,'BIF','figuratif',0,0,'oui'),(28134,1,1,1,NULL,'JACK DANIELS',0,NULL,NULL,NULL,7500,200,1,1500000,'BIF','figuratif',10,0,'oui'),(28135,1,1,1,NULL,'SANDWICH QU POULET',0,NULL,NULL,NULL,2500,200,1,600000,'BIF','figuratif',10,0,'oui'),(28136,1,1,1,NULL,'CUISSE DE POULET ',0,NULL,NULL,NULL,10000,200,1,2000000,'BIF','figuratif',10,0,'oui'),(28137,1,1,1,NULL,'POULET AU CURRY',0,NULL,NULL,NULL,13000,200,1,2600000,'BIF','figuratif',10,0,'oui'),(28139,1,1,1,NULL,'PIZZW AUX POULET',0,NULL,NULL,NULL,12000,200,1,2400000,'BIF','figuratif',10,0,'oui'),(28140,1,1,1,NULL,'PORTION FROMAGE MAT',0,NULL,NULL,NULL,2500,200,1,500000,'BIF','figuratif',10,0,'oui'),(28141,1,1,1,NULL,'ZILLIKEN AUSLESE TROKEN',0,NULL,NULL,NULL,42000,200,1,8400000,'BIF','figuratif',10,0,'oui'),(28142,1,1,1,NULL,'pizza au thon',0,NULL,NULL,NULL,13000,200,1,2600000,'BIF','figuratif',10,0,'oui'),(28143,1,1,1,NULL,'RAMBA',0,NULL,NULL,NULL,1500,200,1,300000,'BIF','figuratif',10,0,'oui'),(28144,1,1,1,NULL,'PAUSE CAFE',0,NULL,NULL,NULL,2000,200,1,400000,'BIF','figuratif',10,0,'oui'),(28145,1,1,1,NULL,'SAUCE  PORTUGAISE',0,NULL,NULL,NULL,1500,200,1,300000,'BIF','figuratif',10,0,'oui'),(28146,1,1,1,NULL,'PLAT SPECIALE ANDRE',0,NULL,NULL,NULL,10000,200,1,2000000,'BIF','figuratif',10,0,'oui'),(28147,1,1,1,NULL,'RAMBA WOTER',0,NULL,NULL,NULL,1200,200,1,240000,'BIF','figuratif',10,0,'oui'),(28150,4,4,6,NULL,'test',1000,0,NULL,NULL,2500,0,4,0,'BIF','figuratif',0,0,'oui'),(28149,1,1,10,NULL,'test',1000,1013,30,1317,2500,1154,4,1169000,'BIF','figuratif',0,0,'oui'),(28154,5,5,12,NULL,'brochette',1000,NULL,25,NULL,8000,0,4,0,'BIF','figuratif',0,0,'oui'),(28155,1,5,13,NULL,'viande',1,1,25,1,0,110400,3,90600,'BIF','figuratif',0,0,'oui'),(28156,1,5,13,NULL,'oignon',100,1000,25,1250,0,1000074,4,1000008340,'BIF','figuratif',0,0,'oui'),(28157,1,5,12,NULL,'brochette spÃ©cial',0,1500,50,2250,1700,0,4,0,'BIF','figuratif',10,0,'oui'),(28158,1,1,1,NULL,'isosi',0,NULL,NULL,NULL,1000,200,1,0,'BIF','figuratif',10,0,'oui'),(28159,1,1,1,NULL,'hfkjggjgfkd',0,NULL,NULL,NULL,2000,200,1,0,'BIF','figuratif',10,0,'oui'),(28160,1,1,1,NULL,'vodka2',0,NULL,10,0,10,1,4,0,'BIF','figuratif',5,0,'oui'),(28161,1,1,7,NULL,'tropical',500,600,200,1800,1500,50,4,30000,'BIF','figuratif',10,0,'oui'),(28162,1,1,1,NULL,'ing',0,NULL,NULL,NULL,100,0,1,0,'BIF','figuratif',10,0,'oui'),(28163,1,5,13,NULL,'testi',0,0,0,0,100,0,0,0,'BIF','figuratif',10,0,'oui'),(28164,1,1,11,NULL,'testab',0,NULL,0,NULL,0,0,1,0,'BIF','figuratif',0,0,'oui'),(28165,1,1,10,NULL,'AQUA PLUS',1000,971,50,1457,1500,14,4,13600,'BIF','simple',NULL,0,'oui'),(28166,0,0,0,NULL,'iii',0,NULL,0,NULL,0,NULL,1,0,'BIF','',0,0,'oui'),(28167,0,0,0,NULL,'u',0,NULL,0,NULL,0,NULL,1,0,'BIF','',0,0,'oui'),(28168,6,5,13,NULL,'salsa',500,458,0,458,500,25,4,11460,'BIF','simple',0,0,'oui'),(28170,1,1,11,NULL,'AKEZA',3000,3000,50,4500,4500,10,4,30000,'BIF','simple',10,0,'oui'),(28171,1,5,13,NULL,'URUMOGI',0,0,0,0,2000,0,0,0,'BIF','figuratif',10,0,'oui'),(28172,1,5,13,NULL,'IGITOKI',0,0,0,0,1500,0,0,0,'BIF','figuratif',10,0,'oui');
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proformas`
--

DROP TABLE IF EXISTS `proformas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proformas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `facture_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `quantite` double NOT NULL,
  `PU` double NOT NULL,
  `montant` int(11) NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tier_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proformas`
--

LOCK TABLES `proformas` WRITE;
/*!40000 ALTER TABLE `proformas` DISABLE KEYS */;
INSERT INTO `proformas` VALUES (1,127,'Pause CafÃ©',10,10000,100000,'BIF',35,'2012-04-13 10:40:21','2012-04-13 10:41:26',9),(2,127,'Pause dÃ©jeuner',10,15000,150000,'BIF',35,'2012-04-13 10:41:05','2012-04-13 10:41:26',9);
/*!40000 ALTER TABLE `proformas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietaires`
--

DROP TABLE IF EXISTS `proprietaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proprietaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `adresse` text NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietaires`
--

LOCK TABLES `proprietaires` WRITE;
/*!40000 ALTER TABLE `proprietaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recettes`
--

DROP TABLE IF EXISTS `recettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recettes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) DEFAULT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `stock_id` int(11) NOT NULL,
  `produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `unite_id` int(11) DEFAULT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `benefice` double DEFAULT NULL,
  `monnaie` varchar(50) NOT NULL,
  `echange` varchar(50) DEFAULT NULL,
  `quantite_printed` double DEFAULT '0',
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recettes`
--

LOCK TABLES `recettes` WRITE;
/*!40000 ALTER TABLE `recettes` DISABLE KEYS */;
INSERT INTO `recettes` VALUES (1,NULL,1,1,28084,1,NULL,3000,3000,3000,'BIF',NULL,NULL,30,'2012-03-24 20:20:03','2012-03-24 20:20:03'),(2,NULL,1,1,27595,2,NULL,2500,5000,5000,'BIF',NULL,NULL,30,'2012-03-24 20:23:32','2012-03-24 20:23:32'),(7,NULL,5,1,17,2,NULL,1500,3000,3000,'BIF',NULL,NULL,30,'2012-03-24 20:53:14','2012-03-24 20:53:14'),(4,NULL,2,1,16689,1,NULL,3000,3000,3000,'BIF',NULL,NULL,30,'2012-03-24 20:27:15','2012-03-24 20:27:15'),(5,1,3,1,18625,1,NULL,3500,3500,3500,'BIF',NULL,NULL,30,'2012-03-24 20:28:08','2012-03-24 20:28:08'),(6,0,4,1,18625,1,NULL,3500,3500,NULL,'BIF',NULL,NULL,30,'2012-03-24 20:28:17','2012-03-24 20:28:17'),(8,2,6,1,19888,1,NULL,3000,3000,3000,'BIF',NULL,NULL,30,'2012-03-24 20:55:17','2012-03-24 20:55:17'),(9,2,6,1,13660,1,NULL,3000,3000,NULL,'BIF',NULL,NULL,30,'2012-03-24 20:55:50','2012-03-24 20:55:50'),(10,2,6,1,11068,1,NULL,3000,3000,3000,'BIF',NULL,NULL,30,'2012-03-24 20:56:18','2012-03-24 20:56:18'),(11,2,7,1,19888,1,NULL,3000,3000,NULL,'BIF',NULL,NULL,29,'2012-03-24 21:00:14','2012-03-24 21:00:14'),(12,2,8,1,11068,1,NULL,1000,1000,NULL,'BIF',NULL,NULL,29,'2012-03-24 21:00:26','2012-03-24 21:00:26'),(13,0,9,1,11070,2,NULL,5000,10000,NULL,'BIF',NULL,NULL,30,'2012-03-24 21:10:32','2012-03-24 21:10:32'),(14,0,10,1,11070,1,NULL,5000,5000,NULL,'BIF',NULL,NULL,29,'2012-03-24 21:11:10','2012-03-24 20:39:20'),(15,3,11,1,28084,1,NULL,3000,3000,NULL,'BIF',NULL,NULL,11,'2012-03-24 21:11:32','2012-03-24 21:11:32'),(16,3,12,1,25420,1,NULL,3000,3000,3000,'BIF',NULL,NULL,30,'2012-03-24 21:12:15','2012-03-24 21:12:15'),(17,0,13,1,25420,1,NULL,3000,3000,NULL,'BIF',NULL,NULL,11,'2012-03-24 21:13:14','2012-03-24 21:13:14'),(18,0,10,1,27595,1,NULL,2500,2500,NULL,'BIF',NULL,NULL,29,'2012-03-24 20:38:40','2012-03-24 20:38:40'),(19,0,10,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,NULL,29,'2012-03-24 20:38:51','2012-03-24 20:38:51'),(20,0,10,1,28084,1,NULL,3000,3000,NULL,'BIF',NULL,NULL,29,'2012-03-24 20:38:57','2012-03-24 20:38:57'),(21,0,10,1,3,1,NULL,2000,2000,2000,'BIF',NULL,NULL,30,'2012-03-24 20:39:03','2012-03-24 20:39:03'),(22,0,10,1,28049,1,NULL,6000,6000,6000,'BIF',NULL,NULL,30,'2012-03-24 20:42:20','2012-03-24 20:42:20'),(24,0,14,1,27595,2,NULL,2500,5000,0,'BIF',NULL,NULL,11,'2012-03-24 20:52:24','2012-03-24 20:53:19'),(25,0,15,1,28160,7,NULL,10,70,0,'BIF',NULL,NULL,30,'2012-03-25 16:22:38','2012-03-25 20:01:13'),(27,NULL,17,1,28085,5,NULL,5000,25000,50000,'BIF',NULL,NULL,30,'2012-03-25 16:24:52','2012-03-25 16:25:04'),(28,NULL,18,1,27595,-2,NULL,2500,-5000,0,'BIF',NULL,NULL,11,'2012-03-25 16:28:12','2012-03-25 16:28:33'),(29,NULL,19,1,27593,-1,NULL,1000,-1000,0,'BIF',NULL,NULL,30,'2012-03-25 16:34:46','2012-03-25 16:34:59'),(30,NULL,20,1,19888,6,NULL,3000,18000,0,'BIF',NULL,NULL,11,'2012-03-25 16:38:50','2012-03-25 16:38:54'),(31,0,21,1,27595,1,NULL,2500,2500,NULL,'BIF',NULL,NULL,11,'2012-03-25 16:53:14','2012-03-25 16:53:14'),(32,0,22,1,27595,1,NULL,2500,2500,NULL,'BIF',NULL,NULL,11,'2012-03-25 16:54:38','2012-03-25 16:54:38'),(33,0,23,1,17072,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-25 20:36:40','2012-03-25 20:36:40'),(34,0,23,1,2,1,NULL,2000,2000,NULL,'BIF',NULL,NULL,30,'2012-03-25 20:36:47','2012-03-25 20:36:47'),(35,0,24,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-26 10:14:41','2012-03-26 10:14:41'),(36,NULL,0,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-26 13:16:13','2012-03-26 13:16:13'),(37,0,25,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-26 13:17:02','2012-03-26 13:17:02'),(38,0,26,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-26 13:18:04','2012-03-26 13:18:04'),(39,0,27,1,26,1,NULL,2500,2500,NULL,'BIF',NULL,NULL,30,'2012-03-26 13:20:10','2012-03-26 13:20:10'),(40,NULL,28,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,29,'2012-03-26 13:21:08','2012-03-26 13:21:08'),(41,NULL,29,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,29,'2012-03-26 13:22:38','2012-03-26 13:22:38'),(42,NULL,30,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,29,'2012-03-26 13:22:49','2012-03-26 13:22:49'),(43,NULL,31,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,29,'2012-03-26 13:22:57','2012-03-26 13:22:57'),(44,NULL,32,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,29,'2012-03-26 13:23:12','2012-03-26 13:23:12'),(45,0,33,1,2,1,NULL,2000,2000,NULL,'BIF',NULL,NULL,29,'2012-03-26 14:45:02','2012-03-26 14:45:02'),(46,0,34,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,NULL,30,'2012-03-26 14:45:45','2012-03-26 14:45:45'),(47,NULL,35,1,27594,1,NULL,2500,2500,NULL,'BIF',NULL,NULL,30,'2012-03-26 14:48:26','2012-03-26 14:48:26'),(48,NULL,36,1,27594,1,NULL,2500,2500,NULL,'BIF',NULL,NULL,11,'2012-03-26 14:48:59','2012-03-26 14:48:59'),(49,0,37,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,29,'2012-03-26 17:47:26','2012-03-26 17:47:26'),(50,0,38,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-26 17:47:57','2012-03-26 17:47:57'),(51,0,39,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,NULL,30,'2012-03-26 17:49:55','2012-03-26 17:49:55'),(52,0,40,1,4351,1,NULL,1200,1200,NULL,'BIF',NULL,NULL,30,'2012-03-26 18:05:30','2012-03-26 18:05:30'),(53,NULL,41,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,NULL,29,'2012-03-26 18:34:39','2012-03-26 18:34:39'),(54,0,42,1,26,1,NULL,2500,2500,NULL,'BIF',NULL,1,30,'2012-03-26 18:34:59','2012-03-26 18:34:59'),(55,0,43,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,1,30,'2012-03-27 07:33:03','2012-03-27 07:33:03'),(56,0,43,1,28154,1,NULL,8000,8000,NULL,'BIF',NULL,1,30,'2012-03-27 07:33:18','2012-03-27 07:33:18'),(57,0,43,1,11047,5,NULL,13000,65000,0,'BIF',NULL,5,30,'2012-03-27 07:33:23','2012-03-27 08:13:59'),(58,0,43,1,1116,1,NULL,40000,40000,NULL,'BIF',NULL,1,30,'2012-03-27 07:33:27','2012-03-27 07:33:27'),(59,0,43,1,2,4,NULL,2000,8000,NULL,'BIF',NULL,4,30,'2012-03-27 07:33:43','2012-03-27 07:33:43'),(60,0,43,1,36,1,NULL,6000,6000,NULL,'BIF',NULL,1,30,'2012-03-27 07:34:01','2012-03-27 07:34:01'),(61,0,43,1,8,1,NULL,1200,1200,NULL,'BIF',NULL,1,30,'2012-03-27 07:51:35','2012-03-27 07:51:35'),(62,0,43,1,6,3,NULL,1200,3600,0,'BIF',NULL,3,30,'2012-03-27 07:54:12','2012-03-27 09:31:54'),(63,0,43,1,13660,2,NULL,3000,6000,0,'BIF',NULL,2,30,'2012-03-27 07:57:42','2012-03-27 09:30:43'),(64,0,43,1,10709,1,NULL,3500,3500,NULL,'BIF',NULL,1,30,'2012-03-27 08:12:19','2012-03-27 08:12:19'),(65,NULL,44,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,1,11,'2012-03-27 09:28:18','2012-03-27 09:28:18'),(66,0,42,1,6,1,NULL,1200,1200,NULL,'BIF',NULL,1,30,'2012-03-27 09:33:17','2012-03-27 09:33:17'),(67,0,42,1,25,1,NULL,2000,2000,NULL,'BIF',NULL,1,30,'2012-03-27 09:33:22','2012-03-27 09:33:22'),(68,0,42,1,28133,1,NULL,5000,5000,NULL,'BIF',NULL,1,30,'2012-03-27 09:35:03','2012-03-27 09:35:03'),(69,0,42,1,28161,6,NULL,1500,9000,0,'BIF',NULL,6,30,'2012-03-27 09:35:08','2012-03-27 09:38:31'),(70,0,42,1,11048,1,NULL,12000,12000,NULL,'BIF',NULL,1,30,'2012-03-27 09:39:42','2012-03-27 09:39:42'),(71,0,42,1,10105,1,NULL,2500,2500,NULL,'BIF',NULL,1,30,'2012-03-27 09:39:47','2012-03-27 09:39:47'),(72,0,42,1,11047,1,NULL,13000,13000,NULL,'BIF',NULL,1,30,'2012-03-27 09:39:51','2012-03-27 09:39:51'),(73,0,45,1,28049,1,NULL,6000,6000,NULL,'BIF',NULL,0,30,'2012-03-27 16:48:48','2012-03-27 16:48:48'),(74,0,46,1,6,1,NULL,1200,1200,NULL,'BIF',NULL,1,30,'2012-03-27 16:50:02','2012-03-27 16:50:02'),(75,0,46,1,11050,1,NULL,10000,10000,NULL,'BIF',NULL,1,30,'2012-03-27 17:52:12','2012-03-27 17:52:12'),(76,0,46,1,181,1,NULL,13000,13000,NULL,'BIF',NULL,1,30,'2012-03-27 17:52:15','2012-03-27 17:52:15'),(77,0,46,1,185,4,NULL,1200,4800,NULL,'BIF',NULL,4,30,'2012-03-27 17:52:26','2012-03-27 17:52:26'),(78,0,46,1,28133,1,NULL,5000,5000,NULL,'BIF',NULL,1,30,'2012-03-27 17:58:18','2012-03-27 17:58:18'),(79,0,47,1,28112,1,NULL,10000,10000,NULL,'BIF',NULL,0,30,'2012-03-28 18:02:17','2012-03-28 18:02:17'),(80,0,48,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-03-28 18:12:35','2012-03-28 18:12:35'),(81,0,49,1,185,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-03-28 18:14:25','2012-03-28 18:14:25'),(82,0,50,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-03-28 18:19:49','2012-03-28 18:19:49'),(83,2,51,1,28127,1,NULL,10000,10000,NULL,'BIF',NULL,0,30,'2012-03-28 18:25:52','2012-03-28 18:25:52'),(84,0,52,1,28127,1,NULL,10000,10000,NULL,'BIF',NULL,0,30,'2012-03-28 18:26:59','2012-03-28 18:26:59'),(85,0,54,1,185,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-03-30 22:50:16','2012-03-30 22:50:16'),(86,0,55,1,17,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-03-30 22:56:16','2012-03-30 22:56:16'),(87,0,56,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 22:58:55','2012-03-30 22:58:55'),(89,NULL,NULL,0,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:24:09','2012-03-30 23:24:09'),(90,NULL,NULL,0,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:26:23','2012-03-30 23:26:23'),(91,NULL,NULL,0,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:28:09','2012-03-30 23:28:09'),(92,0,57,1,17,6,NULL,1500,9000,NULL,'BIF',NULL,0,30,'2012-03-30 23:29:53','2012-03-30 23:32:18'),(94,0,57,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:31:59','2012-03-30 23:31:59'),(95,0,58,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:36:21','2012-03-30 23:36:21'),(96,0,59,1,17,3,NULL,1500,4500,500,'BIF',NULL,0,30,'2012-03-30 23:36:34','2012-03-30 23:37:00'),(97,NULL,60,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:48:38','2012-03-30 23:48:38'),(98,NULL,61,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:48:57','2012-03-30 23:48:57'),(99,0,62,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:50:04','2012-03-30 23:50:04'),(100,0,63,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-03-30 23:50:15','2012-03-30 23:50:15'),(102,1,65,1,28128,1,NULL,2000,2000,NULL,'BIF',NULL,0,30,'2012-03-31 11:05:57','2012-03-31 11:05:57'),(103,1,65,1,185,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-03-31 11:06:55','2012-03-31 11:06:55'),(104,0,67,1,28133,1,NULL,5000,5000,NULL,'BIF',NULL,0,30,'2012-03-31 11:39:32','2012-03-31 11:39:32'),(105,0,68,1,5,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-03-31 11:40:02','2012-03-31 11:40:02'),(106,0,69,1,185,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-03-31 11:40:36','2012-03-31 11:40:36'),(107,2,70,1,25,1,NULL,2000,2000,NULL,'BIF',NULL,1,11,'2012-03-31 11:41:40','2012-04-02 19:00:06'),(108,2,70,1,185,1,NULL,1200,1200,NULL,'BIF',NULL,1,11,'2012-03-31 11:41:52','2012-04-02 19:00:06'),(109,2,70,1,28113,1,NULL,5000,5000,NULL,'BIF',NULL,0,11,'2012-03-31 11:41:57','2012-04-02 19:00:06'),(110,2,70,1,28154,1,NULL,8000,8000,NULL,'BIF',NULL,1,11,'2012-03-31 11:42:34','2012-04-02 19:00:06'),(111,2,70,1,11048,1,NULL,12000,12000,NULL,'BIF',NULL,1,11,'2012-03-31 11:42:37','2012-04-02 19:00:05'),(112,2,70,1,10105,1,NULL,2500,2500,NULL,'BIF',NULL,1,11,'2012-03-31 11:42:41','2012-04-02 19:00:05'),(113,0,71,1,5,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-04-02 13:14:50','2012-04-02 13:14:50'),(116,0,73,1,21,3,NULL,4000,12000,0,'BIF',NULL,0,30,'2012-04-03 18:38:38','2012-04-03 21:59:51'),(117,0,73,1,6,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-04-03 18:38:48','2012-04-03 18:38:48'),(118,NULL,74,1,25,5,NULL,2000,10000,0,'BIF',NULL,0,11,'2012-04-03 22:13:08','2012-04-03 22:13:15'),(121,2,75,1,25,4,NULL,2000,8000,0,'BIF',NULL,0,30,'2012-04-03 22:20:13','2012-04-03 22:21:42'),(122,0,76,1,25,4,NULL,2000,8000,0,'BIF',NULL,0,30,'2012-04-03 22:22:30','2012-04-03 22:29:10'),(123,NULL,77,1,25,2,NULL,2000,4000,0,'BIF',NULL,0,30,'2012-04-03 22:38:07','2012-04-03 22:38:10'),(124,0,78,1,25,2,NULL,2000,4000,0,'BIF',NULL,0,30,'2012-04-03 23:21:36','2012-04-03 23:21:40'),(125,0,79,1,6,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-04-03 23:22:32','2012-04-03 23:22:32'),(131,0,81,1,28161,1,NULL,1500,1500,0,'BIF',NULL,0,30,'2012-04-03 23:32:53','2012-04-03 23:34:14'),(130,0,81,1,8,1,NULL,1200,1200,0,'BIF',NULL,0,30,'2012-04-03 23:32:09','2012-04-03 23:32:38'),(133,0,82,1,28165,1,NULL,1500,1500,600,'BIF',NULL,0,11,'2012-04-05 16:53:07','2012-04-05 16:53:07'),(134,0,83,1,25,1,NULL,2000,2000,NULL,'BIF',NULL,0,30,'2012-04-05 18:53:08','2012-04-05 18:53:08'),(135,5,85,1,22,3,NULL,6000,18000,NULL,'BIF',NULL,0,30,'2012-04-05 19:51:54','2012-04-05 19:51:54'),(137,5,86,1,11430,1,NULL,10000,10000,NULL,'BIF',NULL,0,30,'2012-04-05 19:56:28','2012-04-05 19:56:28'),(138,5,87,1,22,1,NULL,6000,6000,NULL,'BIF',NULL,0,30,'2012-04-05 20:07:50','2012-04-05 20:07:50'),(140,0,91,1,1530,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-04-08 22:21:30','2012-04-08 22:21:30'),(141,NULL,92,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-08 22:23:55','2012-04-08 22:23:55'),(142,NULL,93,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-08 22:57:32','2012-04-08 22:57:32'),(143,NULL,94,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-08 22:57:55','2012-04-08 22:57:55'),(144,NULL,95,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-08 22:58:47','2012-04-08 22:58:47'),(145,NULL,96,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-08 23:01:01','2012-04-08 23:01:01'),(146,2,97,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:06:13','2012-04-09 01:06:13'),(147,2,98,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:08:39','2012-04-09 01:08:39'),(148,0,99,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:10:08','2012-04-09 01:10:08'),(149,0,100,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:11:14','2012-04-09 01:11:14'),(150,0,101,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:12:52','2012-04-09 01:12:52'),(151,0,102,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:14:37','2012-04-09 01:14:37'),(152,2,103,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 01:16:33','2012-04-09 01:16:33'),(153,NULL,104,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 10:38:31','2012-04-09 10:38:31'),(154,NULL,105,1,17,3,NULL,1500,4500,1500,'BIF',NULL,0,11,'2012-04-09 10:40:48','2012-04-09 10:44:10'),(155,0,106,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 10:49:57','2012-04-09 10:49:57'),(156,9,107,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:12:47','2012-04-09 11:12:47'),(157,9,108,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:20:34','2012-04-09 11:20:34'),(158,9,109,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:21:45','2012-04-09 11:21:45'),(159,9,110,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:31:31','2012-04-09 11:31:31'),(160,9,111,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:42:20','2012-04-09 11:42:20'),(161,9,112,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:44:26','2012-04-09 11:44:26'),(162,0,113,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:45:46','2012-04-09 11:45:46'),(163,0,114,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:47:06','2012-04-09 11:47:06'),(164,9,115,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-09 11:48:40','2012-04-09 11:48:40'),(165,0,128,1,1530,2,NULL,1200,2400,NULL,'BIF',NULL,0,30,'2012-04-13 10:59:43','2012-04-13 10:59:43'),(166,0,129,1,1530,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-04-13 11:03:45','2012-04-13 11:03:45'),(167,0,129,1,5,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-04-13 11:05:43','2012-04-13 11:05:43'),(168,0,129,1,28092,1,NULL,3000,3000,NULL,'BIF',NULL,0,30,'2012-04-13 11:06:06','2012-04-13 11:06:06'),(172,NULL,131,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-13 11:32:49','2012-04-13 11:32:49'),(170,1,130,1,11026,1,NULL,15000,15000,0,'BIF',NULL,0,30,'2012-04-13 11:14:45','2012-04-13 11:15:37'),(171,1,130,1,28089,1,NULL,3500,3500,NULL,'BIF',NULL,0,30,'2012-04-13 11:15:09','2012-04-13 11:15:09'),(173,0,132,1,17,1,NULL,1500,1500,500,'BIF',NULL,1,30,'2012-04-13 11:35:40','2012-04-13 11:35:40'),(174,0,132,1,28154,1,NULL,8000,8000,NULL,'BIF',NULL,1,30,'2012-04-13 11:54:14','2012-04-13 11:54:14'),(175,0,132,1,11047,1,NULL,13000,13000,NULL,'BIF',NULL,1,30,'2012-04-13 11:54:19','2012-04-13 11:54:19'),(176,0,132,1,5,1,NULL,1500,1500,NULL,'BIF',NULL,1,30,'2012-04-13 11:54:23','2012-04-13 11:54:23'),(177,14,134,1,5,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-04-17 09:19:19','2012-04-17 09:19:20'),(178,14,134,1,21,1,NULL,4000,4000,NULL,'BIF',NULL,0,30,'2012-04-17 09:20:02','2012-04-17 09:20:02'),(179,0,135,1,28165,2,NULL,1500,3000,1200,'BIF',NULL,0,30,'2012-04-17 09:20:48','2012-04-17 09:20:48'),(180,14,134,1,11048,1,NULL,12000,12000,NULL,'BIF',NULL,0,30,'2012-04-17 09:21:58','2012-04-17 09:21:58'),(181,0,135,1,11051,1,NULL,10000,10000,NULL,'BIF',NULL,0,30,'2012-04-17 09:22:11','2012-04-17 09:22:11'),(182,0,136,1,28049,1,NULL,6000,6000,NULL,'BIF',NULL,0,30,'2012-04-17 09:22:26','2012-04-17 09:22:26'),(183,9,137,1,28165,3,NULL,1500,4500,1800,'BIF',NULL,0,30,'2012-04-17 09:33:28','2012-04-17 09:33:28'),(184,9,137,1,17072,1,NULL,1200,1200,NULL,'BIF',NULL,0,30,'2012-04-17 09:33:38','2012-04-17 09:33:38'),(185,9,137,1,36,1,NULL,6000,6000,NULL,'BIF',NULL,0,30,'2012-04-17 09:33:51','2012-04-17 09:33:51'),(186,9,137,1,72,1,NULL,11000,11000,NULL,'BIF',NULL,0,30,'2012-04-17 09:34:00','2012-04-17 09:34:00'),(187,0,138,1,185,2,NULL,1200,2400,NULL,'BIF',NULL,2,30,'2012-04-17 11:17:09','2012-04-17 11:17:09'),(188,0,138,1,11050,1,NULL,10000,10000,NULL,'BIF',NULL,1,30,'2012-04-17 11:19:24','2012-04-17 11:19:24'),(189,0,138,1,10105,1,NULL,2500,2500,NULL,'BIF',NULL,1,30,'2012-04-17 11:19:35','2012-04-17 11:19:35'),(190,0,138,1,545,1,NULL,4000,4000,NULL,'BIF',NULL,1,30,'2012-04-17 11:19:46','2012-04-17 11:19:46'),(191,9,139,1,28172,1,NULL,1500,1500,NULL,'BIF',NULL,0,30,'2012-04-17 11:38:04','2012-04-17 11:38:04'),(192,9,139,1,28133,1,NULL,5000,5000,NULL,'BIF',NULL,0,30,'2012-04-17 11:38:14','2012-04-17 11:38:14'),(193,9,139,1,21,1,NULL,4000,4000,NULL,'BIF',NULL,0,30,'2012-04-17 11:38:19','2012-04-17 11:38:19'),(196,15,141,1,10401,1,NULL,17000,17000,NULL,'BIF',NULL,0,30,'2012-04-17 12:02:40','2012-04-17 12:02:40'),(195,15,140,1,5,2,NULL,1500,3000,0,'BIF',NULL,0,36,'2012-04-17 11:42:04','2012-04-17 11:42:23'),(197,NULL,142,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-17 12:11:17','2012-04-17 12:11:17'),(198,NULL,143,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-18 15:19:11','2012-04-18 15:19:11'),(199,NULL,144,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,11,'2012-04-18 15:20:01','2012-04-18 15:20:01'),(200,NULL,145,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-18 15:20:44','2012-04-18 15:20:44'),(201,NULL,146,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-18 15:21:25','2012-04-18 15:21:25'),(202,NULL,147,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-18 15:22:08','2012-04-18 15:22:08'),(203,NULL,148,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-18 15:30:23','2012-04-18 15:30:23'),(204,NULL,149,1,17,1,NULL,1500,1500,500,'BIF',NULL,0,30,'2012-04-18 15:49:53','2012-04-18 15:49:53');
/*!40000 ALTER TABLE `recettes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relations`
--

DROP TABLE IF EXISTS `relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` bigint(20) NOT NULL,
  `premier_produit_id` bigint(20) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `deuxieme_produit_id` bigint(20) NOT NULL,
  `quantite` double NOT NULL,
  `unite_id` bigint(20) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relations`
--

LOCK TABLES `relations` WRITE;
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refunds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `journal_id` bigint(20) DEFAULT NULL,
  `facture_id` bigint(20) NOT NULL,
  `montant` double NOT NULL,
  `montant_equivalent` double DEFAULT NULL,
  `monnaie` varchar(50) NOT NULL,
  `caiss_id` bigint(20) NOT NULL,
  `mode_paiement` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refunds`
--

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
INSERT INTO `refunds` VALUES (1,1,4,3500,NULL,'BIF',2,'cash','','2012-03-24',30,'2012-03-24 20:41:06','2012-03-24 20:41:06'),(2,1,3,500,NULL,'',1,'cash','','2012-03-24',30,'2012-03-24 20:50:16','2012-03-24 20:50:16'),(3,3,13,3000,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-03-24 20:35:48','2012-03-24 20:35:48'),(4,3,22,2500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-03-25 16:54:44','2012-03-25 16:54:44'),(5,3,21,2500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-03-25 16:55:06','2012-03-25 16:55:06'),(6,3,9,10000,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-03-25 16:55:35','2012-03-25 16:55:35'),(7,3,15,70,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-03-25 20:06:39','2012-03-25 20:06:39'),(8,2,24,1200,NULL,'BIF',2,'cash','','2012-03-24',29,'2012-03-26 10:14:47','2012-03-26 10:14:47'),(9,2,23,3200,NULL,'BIF',2,'cash','','2012-03-24',29,'2012-03-26 10:15:53','2012-03-26 10:15:53'),(10,2,10,20000,NULL,'BIF',2,'cash','','2012-03-24',29,'2012-03-26 10:16:07','2012-03-26 10:16:07'),(11,4,27,2500,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 14:23:16','2012-03-26 14:23:16'),(12,4,26,1200,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 14:23:21','2012-03-26 14:23:21'),(13,4,25,1200,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 14:23:26','2012-03-26 14:23:26'),(14,2,33,2000,NULL,'BIF',2,'cash','','2012-03-24',29,'2012-03-26 14:45:11','2012-03-26 14:45:11'),(15,5,34,1500,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 14:45:55','2012-03-26 14:45:55'),(16,2,37,1200,NULL,'BIF',2,'cash','','2012-03-24',29,'2012-03-26 17:47:37','2012-03-26 17:47:37'),(17,6,38,1200,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 17:48:06','2012-03-26 17:48:06'),(18,6,39,1500,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 17:50:02','2012-03-26 17:50:02'),(19,7,40,1200,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-26 18:05:35','2012-03-26 18:05:35'),(20,8,43,142800,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-27 11:22:24','2012-03-27 11:22:24'),(21,8,42,47200,NULL,'BIF',2,'cash','','2012-03-26',30,'2012-03-27 11:22:30','2012-03-27 11:22:30'),(22,9,46,34000,NULL,'BIF',2,'cash','','2012-03-27',30,'2012-03-28 18:02:04','2012-03-28 18:02:04'),(23,9,45,6000,NULL,'BIF',2,'cash','','2012-03-27',30,'2012-03-28 18:02:08','2012-03-28 18:02:08'),(24,9,47,10000,NULL,'BIF',2,'cash','','2012-03-27',30,'2012-03-28 18:02:27','2012-03-28 18:02:27'),(25,10,48,1500,NULL,'BIF',2,'cash','','2012-03-28',30,'2012-03-28 18:12:40','2012-03-28 18:12:40'),(26,11,49,1200,NULL,'BIF',2,'cash','','2012-03-28',30,'2012-03-28 18:14:34','2012-03-28 18:14:34'),(27,12,50,1500,NULL,'BIF',2,'cash','','2012-03-28',30,'2012-03-28 18:20:02','2012-03-28 18:20:02'),(28,13,54,1200,NULL,'BIF',2,'cash','','2012-03-28',30,'2012-03-30 22:50:23','2012-03-30 22:50:23'),(29,13,52,10000,NULL,'BIF',2,'cash','','2012-03-28',30,'2012-03-30 22:55:18','2012-03-30 22:55:18'),(30,14,55,1500,NULL,'BIF',2,'cash','','2012-03-30',30,'2012-03-30 22:56:30','2012-03-30 22:56:30'),(45,16,81,2700,NULL,'BIF',2,'cash','','2012-04-03',30,'2012-04-05 18:53:26','2012-04-05 18:53:26'),(32,14,63,1500,NULL,'BIF',2,'cash','','2012-03-30',30,'2012-03-30 23:51:26','2012-03-30 23:51:26'),(33,14,58,1500,NULL,'BIF',2,'cash','','2012-03-30',30,'2012-03-30 23:59:07','2012-03-30 23:59:07'),(34,14,57,10500,NULL,'BIF',2,'cash','','2012-03-30',30,'2012-03-31 00:10:47','2012-03-31 00:10:47'),(42,15,67,5000,NULL,'BIF',2,'cash','','2012-03-31',30,'2012-04-03 18:35:49','2012-04-03 18:35:49'),(36,14,56,1500,NULL,'BIF',2,'cash','','2012-03-30',30,'2012-03-31 11:34:20','2012-03-31 11:34:20'),(43,3,82,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-05 16:53:41','2012-04-05 16:53:41'),(44,16,83,2000,NULL,'BIF',2,'cash','','2012-04-03',30,'2012-04-05 18:53:15','2012-04-05 18:53:15'),(39,15,51,10000,NULL,'',2,'cash','','2012-03-31',30,'2012-04-02 13:15:34','2012-04-02 13:15:34'),(40,15,71,1500,NULL,'BIF',2,'cash','','2012-03-31',30,'2012-04-02 13:15:51','2012-04-02 13:15:51'),(46,16,79,1200,NULL,'BIF',2,'cash','','2012-04-03',30,'2012-04-05 18:53:58','2012-04-05 18:53:58'),(47,16,78,4000,NULL,'BIF',2,'cash','','2012-04-03',30,'2012-04-05 18:54:01','2012-04-05 18:54:01'),(48,16,73,13200,NULL,'BIF',2,'cash','','2012-04-03',30,'2012-04-05 18:54:07','2012-04-05 18:54:07'),(49,16,75,8000,NULL,'BIF',2,'cash','','2012-04-03',30,'2012-04-05 18:54:20','2012-04-05 18:54:20'),(51,17,85,18000,NULL,'BIF',2,'cash','','2012-04-05',30,'2012-04-05 19:55:57','2012-04-05 19:55:57'),(52,17,91,1200,NULL,'BIF',2,'cash','','2012-04-05',30,'2012-04-08 22:21:38','2012-04-08 22:21:38'),(53,3,99,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-09 01:10:13','2012-04-09 01:10:13'),(54,3,100,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-09 01:11:21','2012-04-09 01:11:21'),(55,3,101,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-09 01:12:59','2012-04-09 01:12:59'),(56,3,102,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-09 01:14:41','2012-04-09 01:14:41'),(57,3,106,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-09 10:50:03','2012-04-09 10:50:03'),(58,3,111,1500,NULL,'BIF',2,'cash','','2012-03-24',11,'2012-04-09 11:44:19','2012-04-09 11:44:19'),(63,NULL,120,100010,NULL,'BIF',2,'banque','1001','2012-04-10',11,'2012-04-10 15:23:50','2012-04-10 15:23:50'),(64,NULL,119,1000,NULL,'',2,'cash','','2012-04-11',0,'2012-04-11 11:43:55','2012-04-11 11:43:55'),(66,NULL,122,240,NULL,'USD',2,'cash','','2012-04-11',0,'2012-04-11 14:35:44','2012-04-11 14:35:44'),(67,NULL,125,3500,NULL,'',3,'cash','','2012-04-13',11,'2012-04-13 09:49:12','2012-04-13 09:49:12'),(69,18,129,5700,NULL,'BIF',2,'cash','','2012-04-13',30,'2012-04-13 11:10:49','2012-04-13 11:10:49'),(70,18,128,2400,NULL,'BIF',2,'cash','','2012-04-13',30,'2012-04-13 11:25:41','2012-04-13 11:25:41'),(71,18,132,24000,NULL,'BIF',2,'cash','','2012-04-13',30,'2012-04-13 12:06:20','2012-04-13 12:06:20'),(72,NULL,133,500,NULL,'BIF',3,'cash','','2012-04-14',11,'2012-04-14 12:36:52','2012-04-14 12:36:52'),(75,19,135,13000,NULL,'BIF',2,'cash','','2012-04-17',30,'2012-04-17 09:24:09','2012-04-17 09:24:09'),(76,19,136,6000,NULL,'BIF',2,'cash','','2012-04-17',30,'2012-04-17 09:24:19','2012-04-17 09:24:19'),(77,20,138,18900,NULL,'BIF',2,'cash','','2012-04-17',30,'2012-04-17 11:40:37','2012-04-17 11:40:37'),(78,20,141,12000,NULL,'BIF',2,'cash','','2012-04-17',30,'2012-04-17 12:03:46','2012-04-17 12:03:46'),(79,20,140,3000,NULL,'',2,'cash','','2012-04-17',30,'2012-04-17 12:06:53','2012-04-17 12:06:53');
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_traces`
--

DROP TABLE IF EXISTS `reservation_traces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation_traces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint(20) NOT NULL,
  `operation` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_traces`
--

LOCK TABLES `reservation_traces` WRITE;
/*!40000 ALTER TABLE `reservation_traces` DISABLE KEYS */;
INSERT INTO `reservation_traces` VALUES (1,1,'Prise de la rÃ©servation',11,'2012-03-30 09:47:45'),(2,1,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-03-30 09:47:50'),(3,1,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-03-30 14:56:02'),(4,2,'Prise de la rÃ©servation',11,'2012-03-31 10:42:12'),(5,2,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-03-31 10:42:18'),(6,2,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-03-31 10:49:47'),(7,2,'Changement du PU : de 100 USD Ã  75 USD',11,'2012-03-31 10:52:46'),(8,3,'Prise de la rÃ©servation',11,'2012-03-31 11:02:44'),(9,3,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-03-31 11:02:54'),(10,3,'DÃ©logement : de la chambre 102 Ã  la chambre 101',11,'2012-03-31 11:03:58'),(11,2,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-03-31 11:04:35'),(12,4,'Prise de la rÃ©servation',11,'2012-03-31 11:19:08'),(13,4,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-03-31 11:19:47'),(14,5,'Prise de la rÃ©servation',11,'2012-04-05 19:30:29'),(15,5,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-05 19:31:51'),(16,6,'Prise de la rÃ©servation',11,'2012-04-09 12:12:09'),(17,2,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-04-09 12:53:08'),(18,2,'Changement de l\'etat : de checked_out Ã  confirmed',11,'2012-04-09 12:56:34'),(19,2,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-09 12:56:44'),(20,2,'Changement de l\'etat : de pending Ã  checked_out',11,'2012-04-09 12:57:01'),(21,7,'Prise de la rÃ©servation',11,'2012-04-09 13:03:38'),(22,7,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-09 13:04:00'),(23,8,'Prise de la rÃ©servation',11,'2012-04-09 13:14:08'),(24,9,'Prise de la rÃ©servation',11,'2012-04-09 13:17:24'),(25,8,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-09 13:20:45'),(26,9,'DÃ©logement : de la chambre 202 Ã  la chambre 201',11,'2012-04-09 14:02:14'),(27,9,'Changement de l\'etat : de pending Ã  confirmed',11,'2012-04-10 15:15:52'),(28,10,'Prise de la rÃ©servation',11,'2012-04-10 15:16:07'),(29,11,'Prise de la rÃ©servation',0,'2012-04-11 14:22:53'),(30,12,'Prise de la rÃ©servation',0,'2012-04-11 16:04:03'),(31,13,'Prise de la rÃ©servation',0,'2012-04-11 16:11:10'),(32,2,'Changement de l\'etat : de checked_out Ã  checked_in',0,'2012-04-11 16:12:01'),(33,2,'Changement de l\'etat : de checked_in Ã  checked_out',0,'2012-04-11 16:12:13'),(34,7,'Changement de l\'etat : de checked_in Ã  checked_out',0,'2012-04-11 16:15:05'),(35,8,'Changement de l\'etat : de checked_in Ã  checked_out',0,'2012-04-11 16:15:18'),(36,5,'Changement de l\'etat : de checked_in Ã  checked_out',0,'2012-04-11 16:15:29'),(37,11,'Changement de l\'etat : de pending Ã  checked_out',0,'2012-04-11 16:15:41'),(38,10,'Changement de l\'etat : de pending Ã  checked_in',0,'2012-04-11 16:36:32'),(39,10,'Changement de l\'etat : de checked_in Ã  checked_out',0,'2012-04-11 16:37:27'),(40,14,'Prise de la rÃ©servation',0,'2012-04-11 16:38:25'),(41,15,'Prise de la rÃ©servation',0,'2012-04-11 16:51:02'),(42,16,'Prise de la rÃ©servation',0,'2012-04-11 16:52:40'),(43,9,'Changement du PU : de 100 USD Ã  100 BIF',11,'2012-04-14 16:45:09'),(44,9,'Changement du PU : de 100 BIF Ã  30 BIF',11,'2012-04-14 16:49:55'),(45,14,'Changement du PU : de 80 USD Ã  10000 BIF',11,'2012-04-14 17:48:25'),(46,7,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-17 09:30:03'),(47,7,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-04-18 17:00:44'),(48,7,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:00:51'),(49,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:01:06'),(50,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:02:22'),(51,7,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:02:27'),(52,7,'Changement de l\'etat : de checked_in Ã  pending',11,'2012-04-18 17:02:31'),(53,7,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:03:02'),(54,7,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:03:09'),(55,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:03:17'),(56,7,'Changement de l\'etat : de confirmed Ã  checked_out',11,'2012-04-18 17:03:26'),(57,7,'Changement de l\'etat : de checked_out Ã  confirmed',11,'2012-04-18 17:03:30'),(58,7,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-18 17:03:35'),(59,7,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:03:38'),(60,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:03:43'),(61,7,'Changement de l\'etat : de confirmed Ã  confirmed',11,'2012-04-18 17:03:55'),(62,7,'Changement de l\'etat : de confirmed Ã  confirmed',11,'2012-04-18 17:05:21'),(63,7,'Changement de l\'etat : de confirmed Ã  checked_out',11,'2012-04-18 17:05:34'),(64,7,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:05:48'),(65,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:05:54'),(66,7,'Changement de l\'etat : de confirmed Ã  confirmed',11,'2012-04-18 17:06:01'),(67,7,'Changement de l\'etat : de confirmed Ã  checked_out',11,'2012-04-18 17:08:28'),(68,7,'Changement de l\'etat : de checked_out Ã  confirmed',11,'2012-04-18 17:09:14'),(69,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:10:16'),(70,7,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-04-18 17:10:22'),(71,7,'Changement de l\'etat : de checked_out Ã  pending',11,'2012-04-18 17:10:26'),(72,7,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:10:30'),(73,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:10:37'),(74,7,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-18 17:10:47'),(75,7,'Changement de l\'etat : de pending Ã  confirmed',11,'2012-04-18 17:10:53'),(76,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:10:56'),(77,7,'Changement de l\'etat : de checked_in Ã  pending',11,'2012-04-18 17:11:01'),(78,7,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:11:10'),(79,7,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:11:24'),(80,7,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-04-18 17:12:12'),(81,7,'Changement de l\'etat : de checked_out Ã  confirmed',11,'2012-04-18 17:19:06'),(82,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:19:59'),(83,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:20:04'),(84,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:20:58'),(85,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:21:02'),(86,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:21:05'),(87,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:21:39'),(88,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:21:52'),(89,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:22:00'),(90,7,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:22:07'),(91,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:23:25'),(92,7,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-18 17:23:30'),(93,7,'Changement de l\'etat : de pending Ã  checked_out',11,'2012-04-18 17:23:33'),(94,7,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:23:37'),(95,7,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:23:43'),(96,7,'Changement de l\'etat : de confirmed Ã  checked_out',11,'2012-04-18 17:23:49'),(97,13,'Changement de l\'etat : de pending Ã  canceled',11,'2012-04-18 17:29:38'),(98,8,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:29:46'),(99,8,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:29:54'),(100,8,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:33:38'),(101,13,'Changement de l\'etat : de pending Ã  confirmed',11,'2012-04-18 17:38:37'),(102,13,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-18 17:40:30'),(103,8,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:40:38'),(104,8,'Changement de l\'etat : de checked_in Ã  canceled',11,'2012-04-18 17:40:59'),(105,10,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:41:10'),(106,10,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:41:17'),(107,10,'Changement de l\'etat : de checked_in Ã  pending',11,'2012-04-18 17:41:33'),(108,10,'Changement de l\'etat : de pending Ã  confirmed',11,'2012-04-18 17:41:37'),(109,10,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-18 17:41:41'),(110,10,'Changement de l\'etat : de pending Ã  confirmed',11,'2012-04-18 17:41:48'),(111,10,'Changement de l\'etat : de confirmed Ã  pending',11,'2012-04-18 17:41:52'),(112,10,'Changement de l\'etat : de pending Ã  checked_out',11,'2012-04-18 17:41:56'),(113,10,'Changement de l\'etat : de checked_out Ã  checked_out',11,'2012-04-18 17:41:59'),(114,10,'Changement de l\'etat : de checked_out Ã  checked_out',11,'2012-04-18 17:42:05'),(115,10,'Changement de l\'etat : de checked_out Ã  checked_out',11,'2012-04-18 17:42:08'),(116,10,'Changement de l\'etat : de checked_out Ã  pending',11,'2012-04-18 17:42:14'),(117,10,'Changement de l\'etat : de pending Ã  confirmed',11,'2012-04-18 17:42:18'),(118,10,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:42:23'),(119,10,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-04-18 17:42:45'),(120,10,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:42:50'),(121,10,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:42:57'),(122,10,'Changement de l\'etat : de checked_in Ã  checked_out',11,'2012-04-18 17:43:09'),(123,10,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:44:03'),(124,10,'Changement de l\'etat : de checked_in Ã  pending',11,'2012-04-18 17:44:13'),(125,10,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:44:17'),(126,10,'Changement de l\'etat : de checked_in Ã  pending',11,'2012-04-18 17:44:22'),(127,10,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:44:27'),(128,10,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:45:12'),(129,10,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:45:17'),(130,10,'Changement de l\'etat : de checked_in Ã  confirmed',11,'2012-04-18 17:45:37'),(131,10,'Changement de l\'etat : de confirmed Ã  checked_in',11,'2012-04-18 17:45:41'),(132,10,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:45:46'),(133,5,'Changement de l\'etat : de checked_out Ã  canceled',11,'2012-04-18 17:46:01'),(134,10,'Changement de l\'etat : de checked_in Ã  canceled',11,'2012-04-18 17:46:08'),(135,2,'Changement de l\'etat : de checked_out Ã  canceled',11,'2012-04-18 17:46:17'),(136,15,'Changement de l\'etat : de pending Ã  checked_in',11,'2012-04-18 17:46:23'),(137,11,'Changement de l\'etat : de checked_out Ã  checked_in',11,'2012-04-18 17:46:31'),(138,11,'Changement de l\'etat : de checked_in Ã  checked_in',11,'2012-04-18 17:46:37');
/*!40000 ALTER TABLE `reservation_traces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `type_chambre_id` bigint(20) NOT NULL,
  `nombre` int(11) NOT NULL,
  `adultes` int(11) NOT NULL,
  `enfants` int(11) NOT NULL,
  `checked_in` date NOT NULL,
  `depart` date NOT NULL,
  `demi` tinyint(1) DEFAULT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL,
  `moyen` varchar(50) DEFAULT NULL,
  `contexte` varchar(50) NOT NULL,
  `commentaire` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,2,53,1,1,1,0,'2012-03-01','2012-03-06',NULL,80,480,'USD','checked_out','direct','Tourisme','',11,'2012-03-30 09:47:45','2012-03-30 14:56:02'),(2,1,64,2,1,2,0,'2012-03-04','2012-04-11',0,75,2925,'USD','canceled','direct','Tourisme','',11,'2012-03-31 10:42:12','2012-04-18 17:46:17'),(3,3,NULL,1,1,1,0,'2012-03-10','2012-03-13',NULL,80,320,'USD','checked_in','direct','Tourisme','',11,'2012-03-31 11:02:44','2012-03-31 11:02:54'),(4,2,NULL,2,1,1,0,'2012-03-22','2012-03-31',NULL,100,1000,'USD','checked_in','telephone','Tourisme','',11,'2012-03-31 11:19:08','2012-03-31 11:19:47'),(5,5,84,1,1,1,2,'2012-04-01','2012-04-12',1,72,900,'USD','canceled','email','Tourisme','',11,'2012-04-05 19:30:29','2012-04-18 17:46:01'),(6,5,116,1,1,1,0,'2012-04-05','2012-04-11',NULL,80,560,'USD','canceled','direct','Tourisme','',11,'2012-04-09 12:12:09','2012-04-09 12:15:46'),(7,9,118,1,1,1,0,'2012-04-08','2012-05-02',NULL,80,2000,'USD','canceled','direct','Autre','',11,'2012-04-09 13:03:38','2012-04-18 17:23:55'),(8,5,117,3,1,1,0,'2012-04-19','2012-04-27',0,130,1170,'USD','canceled','direct','Tourisme','',11,'2012-04-09 13:14:08','2012-04-18 17:40:59'),(9,10,121,2,1,1,0,'2012-04-14','2012-04-18',NULL,30,150,'BIF','canceled','direct','Tourisme','',11,'2012-04-09 13:17:24','2012-04-18 17:24:28'),(10,1,NULL,3,1,1,0,'2012-04-07','2012-04-14',NULL,130,1040,'USD','canceled','direct','Tourisme','',11,'2012-04-10 15:16:07','2012-04-18 17:46:08'),(11,11,122,1,1,1,0,'2012-04-01','2012-04-03',NULL,80,240,'USD','checked_in','direct','Tourisme','',11,'2012-04-11 14:22:53','2012-04-18 17:46:37'),(12,11,NULL,1,1,1,0,'2012-04-11','2012-04-11',NULL,80,80,'USD','pending','direct','Tourisme','',0,'2012-04-11 16:04:03','2012-04-11 16:04:03'),(13,11,NULL,1,1,1,0,'2012-04-11','2012-04-11',NULL,80,80,'USD','pending','direct','Tourisme','',11,'2012-04-11 16:11:10','2012-04-18 17:40:30'),(14,11,NULL,1,1,1,0,'2012-04-04','2012-04-06',NULL,10000,30000,'BIF','pending','direct','Tourisme','',11,'2012-04-11 16:38:25','2012-04-11 16:38:25'),(15,11,NULL,2,1,1,0,'2012-04-01','2012-04-03',NULL,100,300,'USD','checked_in','direct','Tourisme','',11,'2012-04-11 16:51:02','2012-04-18 17:46:23'),(16,11,NULL,2,1,1,0,'2012-04-04','2012-04-06',NULL,100,300,'USD','pending','direct','Tourisme','',0,'2012-04-11 16:52:40','2012-04-11 16:52:40');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salaires`
--

DROP TABLE IF EXISTS `salaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salaires` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caiss_id` bigint(20) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `mois` varchar(50) NOT NULL,
  `montant` double NOT NULL,
  `avance` double NOT NULL,
  `reste` double NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salaires`
--

LOCK TABLES `salaires` WRITE;
/*!40000 ALTER TABLE `salaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `salaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salles`
--

DROP TABLE IF EXISTS `salles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `capacite` int(11) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salles`
--

LOCK TABLES `salles` WRITE;
/*!40000 ALTER TABLE `salles` DISABLE KEYS */;
/*!40000 ALTER TABLE `salles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'boissons','',25,'2011-06-07 11:20:30','2012-01-19 12:33:15'),(4,'cartes','',11,'2012-01-07 17:27:05','2012-01-07 17:27:05'),(5,'nourriture','',25,'2012-01-19 12:33:34','2012-01-19 12:33:34'),(6,'pieces de rechange','',35,'2012-04-11 10:02:00','2012-04-11 10:02:31');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `type_service_id` bigint(20) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,3,66,2,20000,'BIF','nettoyage costume,\r\nchaussettes',11,'2012-03-31 11:12:04','2012-04-02 19:59:16'),(2,3,66,1,10000,'BIF','navigation internet',11,'2012-03-31 11:12:25','2012-04-02 19:59:16'),(3,5,88,2,1000,'BIF','',11,'2012-04-07 21:19:22','2012-04-07 21:19:35'),(4,4,89,1,10000,'BIF','',11,'2012-04-07 21:30:08','2012-04-07 21:30:20'),(5,8,90,3,5000,'BIF','',11,'2012-04-07 21:33:10','2012-04-07 21:33:21'),(6,9,119,2,10000,'BIF','costume, pantalon,...',11,'2012-04-09 13:48:45','2012-04-09 13:51:02'),(7,9,119,4,5000,'BIF','une sÃ©ance',11,'2012-04-09 13:49:04','2012-04-09 13:51:02'),(8,7,120,2,100010,'BIF','nettoyage habits, ...',11,'2012-04-10 15:23:09','2012-04-10 15:23:51'),(9,5,123,4,1000,'BIF','',0,'2012-04-11 14:38:23','2012-04-11 14:42:34');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_interdits`
--

DROP TABLE IF EXISTS `stock_interdits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_interdits` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `personnel_id` bigint(20) NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_interdits`
--

LOCK TABLES `stock_interdits` WRITE;
/*!40000 ALTER TABLE `stock_interdits` DISABLE KEYS */;
INSERT INTO `stock_interdits` VALUES (1,31,5),(2,28,4);
/*!40000 ALTER TABLE `stock_interdits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,'bar','Grand stock',11,'2011-06-07 11:20:15','2012-03-24 20:35:15'),(4,'Cartes','reception',25,'2012-01-07 17:26:49','2012-01-19 12:31:08'),(5,'Grand stock','',11,'2012-03-17 14:31:11','2012-03-17 14:31:11'),(6,'cuisine','pour les visiteurs',11,'2012-04-07 19:35:19','2012-04-07 19:35:19');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suggestions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `chambre_id` bigint(20) NOT NULL,
  `suggestion` text NOT NULL,
  `date` date NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suggestions`
--

LOCK TABLES `suggestions` WRITE;
/*!40000 ALTER TABLE `suggestions` DISABLE KEYS */;
/*!40000 ALTER TABLE `suggestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiers`
--

DROP TABLE IF EXISTS `tiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `type` varchar(50) NOT NULL,
  `compagnie` varchar(50) DEFAULT NULL,
  `NIF` varchar(50) NOT NULL,
  `adresse` text,
  `tel` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `nationalite` varchar(40) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `passport` int(11) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiers`
--

LOCK TABLES `tiers` WRITE;
/*!40000 ALTER TABLE `tiers` DISABLE KEYS */;
INSERT INTO `tiers` VALUES (1,'Emmanuel','client','Areva','','','78965782','ema@hotmail.com','congolaise','2012-03-31',19818181,1,11,'2012-03-24 20:46:15','2012-03-31 10:51:28'),(2,'egide','client',NULL,'',NULL,'78458215',NULL,NULL,NULL,NULL,1,29,'2012-03-24 21:00:14','2012-03-24 21:00:14'),(3,'test','client',NULL,'',NULL,'',NULL,NULL,NULL,NULL,1,11,'2012-03-24 20:37:21','2012-03-24 20:37:21'),(4,'Yvan','fournisseur','','','','','','','0000-00-00',NULL,1,11,'2012-03-24 21:43:00','2012-03-24 21:43:00'),(5,'BUYOYA','client','Y','23455',NULL,'0','','B','0000-00-00',45,1,11,'2012-04-05 19:27:20','2012-04-05 19:27:20'),(6,'marche','fournisseur','','','','','','','0000-00-00',NULL,1,11,'2012-04-07 19:47:03','2012-04-07 19:47:03'),(7,'Fabien','fournisseur','salsa compagnie','23456789','','','','','0000-00-00',NULL,1,11,'2012-04-07 19:54:42','2012-04-07 19:54:42'),(8,'TOTO','fournisseur','MUTOYI','3245678','','','','','0000-00-00',NULL,1,11,'2012-04-07 20:18:46','2012-04-07 20:18:46'),(9,'Sonia','client','Socabu','77711','','','sonia@hotmail.com','Burundaise','2012-04-09',100101,1,11,'2012-04-09 11:12:47','2012-04-09 13:58:34'),(10,'Marino','client','Regideso','','','2000222','mugar@yahoo.fr','Burundaise','2032-01-01',2002029,1,11,'2012-04-09 13:16:57','2012-04-09 14:05:53'),(11,'hello world','client','','',NULL,'','','','0000-00-00',1000910,1,0,'2012-04-11 12:11:29','2012-04-11 12:11:29'),(12,'Juma','polyvalent','RAMBA','10191919','asiatique ','79781245','juma@hotmail.com','','0000-00-00',NULL,1,11,'2012-04-13 08:33:25','2012-04-13 08:34:56'),(13,'alex','polyvalent','hkj','3245677','gitega','','gdrt@yahoo.fr','','2012-04-13',NULL,1,11,'2012-04-13 10:06:30','2012-04-13 10:07:46'),(14,'herve','client',NULL,'',NULL,'78907654',NULL,NULL,NULL,NULL,1,30,'2012-04-17 09:23:33','2012-04-17 09:23:33'),(15,'Evariste ','client',NULL,'',NULL,'78688811',NULL,NULL,NULL,NULL,1,36,'2012-04-17 11:59:26','2012-04-17 11:59:26');
/*!40000 ALTER TABLE `tiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transports`
--

DROP TABLE IF EXISTS `transports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `voyage` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `paiement` varchar(50) NOT NULL,
  `monaie` varchar(50) NOT NULL,
  `chauffeur_id` bigint(20) unsigned DEFAULT NULL,
  `tier_id` bigint(20) unsigned DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `contenu` varchar(50) DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `PU` double DEFAULT NULL,
  `montant` double unsigned DEFAULT NULL,
  `avance` double DEFAULT NULL,
  `reste` double DEFAULT NULL,
  `carburant` int(11) DEFAULT NULL,
  `depenses` double DEFAULT NULL,
  `observation` text,
  `date_depart` date DEFAULT NULL,
  `date_checked_in` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transports`
--

LOCK TABLES `transports` WRITE;
/*!40000 ALTER TABLE `transports` DISABLE KEYS */;
/*!40000 ALTER TABLE `transports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_chambres`
--

DROP TABLE IF EXISTS `type_chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_chambres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `capacite` int(11) NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_chambres`
--

LOCK TABLES `type_chambres` WRITE;
/*!40000 ALTER TABLE `type_chambres` DISABLE KEYS */;
INSERT INTO `type_chambres` VALUES (1,'standard',2,80,'USD','',11,'2012-03-30 09:46:01','2012-03-30 09:46:01'),(2,'suite',2,100,'USD','',11,'2012-03-30 09:46:23','2012-03-30 09:46:23'),(3,'deluxe',2,130,'USD','TV,Climatiseur,...',11,'2012-04-09 12:40:28','2012-04-09 12:41:00');
/*!40000 ALTER TABLE `type_chambres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_immobilisations`
--

DROP TABLE IF EXISTS `type_immobilisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_immobilisations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `compte` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_immobilisations`
--

LOCK TABLES `type_immobilisations` WRITE;
/*!40000 ALTER TABLE `type_immobilisations` DISABLE KEYS */;
INSERT INTO `type_immobilisations` VALUES (1,'immeubles',NULL,''),(2,'mobilier',NULL,''),(3,'materiels',NULL,'');
/*!40000 ALTER TABLE `type_immobilisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_services`
--

DROP TABLE IF EXISTS `type_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `compte` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_services`
--

LOCK TABLES `type_services` WRITE;
/*!40000 ALTER TABLE `type_services` DISABLE KEYS */;
INSERT INTO `type_services` VALUES (1,'Internet','rendu',NULL,'internet pour les clients de l\'hÃ´tel',11,'2012-03-31 11:10:55','2012-03-31 11:10:55'),(2,'Blanchissement','rendu',NULL,'nettoyage des vÃªtements ,...',11,'2012-03-31 11:11:24','2012-03-31 11:11:24'),(3,'Nettoyage','recu',NULL,'',11,'2012-04-07 21:32:32','2012-04-07 21:32:32'),(4,'Sauna','rendu',NULL,'',11,'2012-04-09 13:47:29','2012-04-09 13:47:29');
/*!40000 ALTER TABLE `type_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `type` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `compte` int(11) DEFAULT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'alimentation','recette','',0,11,'2012-03-26 18:36:20','2012-03-26 18:36:20'),(2,'divers','depense','',0,11,'2012-03-26 18:36:30','2012-03-26 18:36:30'),(3,'DÃ©placements','depense','toutes les frais concernant le transport ',0,11,'2012-04-13 09:15:21','2012-04-13 09:15:21'),(4,'Communications','depense','achats unitÃ©s ',0,11,'2012-04-13 09:17:49','2012-04-13 09:17:49'),(6,'Cuisine','depense','achats cuisine',0,11,'2012-04-17 09:56:01','2012-04-17 09:56:01');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unites`
--

DROP TABLE IF EXISTS `unites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unites`
--

LOCK TABLES `unites` WRITE;
/*!40000 ALTER TABLE `unites` DISABLE KEYS */;
INSERT INTO `unites` VALUES (1,'kg','Kilogramme',0,'2011-10-11 15:33:59','2011-10-11 15:33:59'),(2,'douzaine','',0,'2011-10-11 15:34:23','2011-10-11 15:34:23'),(3,'g','Gramme',0,'2011-10-11 15:35:37','2011-10-11 15:35:37'),(4,'piece','PiÃƒÂ¨ce ',0,'2011-10-11 15:37:05','2011-10-11 15:37:05'),(5,'morceau','Morceau de viande pour les brochettes',0,'2011-10-11 15:38:56','2011-10-11 15:38:56'),(6,'demi_douzaine','demi douzaine',0,'2011-10-11 15:41:58','2011-10-11 15:41:58');
/*!40000 ALTER TABLE `unites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tier_id` bigint(20) NOT NULL,
  `commande_id` bigint(20) DEFAULT NULL,
  `bon_id` bigint(20) DEFAULT NULL,
  `facture_id` bigint(20) DEFAULT NULL,
  `produit_id` bigint(20) unsigned NOT NULL,
  `quantite` double unsigned NOT NULL,
  `unite_id` bigint(20) NOT NULL,
  `PU` double NOT NULL,
  `montant` double NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `echange` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `personnel_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventes`
--

LOCK TABLES `ventes` WRITE;
/*!40000 ALTER TABLE `ventes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `virements`
--

DROP TABLE IF EXISTS `virements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `virements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caisse_sortant_id` bigint(20) DEFAULT NULL,
  `first_personnel_id` bigint(20) DEFAULT NULL,
  `creation` datetime NOT NULL,
  `modification` datetime NOT NULL,
  `montant` double NOT NULL,
  `montant_equivalent` double DEFAULT NULL,
  `monnaie` varchar(50) NOT NULL,
  `caisse_entrant_id` bigint(20) DEFAULT NULL,
  `second_personnel_id` bigint(20) DEFAULT NULL,
  `confirmation` datetime DEFAULT NULL,
  `date` date NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `virements`
--

LOCK TABLES `virements` WRITE;
/*!40000 ALTER TABLE `virements` DISABLE KEYS */;
INSERT INTO `virements` VALUES (1,3,11,'2012-04-13 09:35:21','2012-04-13 09:35:21',6000,NULL,'BIF',2,35,'2012-04-13 09:38:28','2012-04-13','confert reÃ§u NÂ° 10'),(2,2,11,'2012-04-17 10:39:04','2012-04-17 10:39:04',5000,NULL,'BIF',3,11,'2012-04-17 10:39:27','2012-04-17','cfr recu NÂ°14');
/*!40000 ALTER TABLE `virements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-04-19 10:45:30
