-- --------------------------------------------------------
-- Host:                         91.208.99.2
-- Server version:               5.6.14-56 - Percona Server (GPL), Release rel62.0, Revision 483
-- Server OS:                    Linux
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table classinfo
CREATE TABLE IF NOT EXISTS `classinfo` (
  `id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `avatar_url` tinytext,
  `rank` tinytext,
  `gladiator` tinyint(2) NOT NULL DEFAULT '0',
  `pugilist` tinyint(2) NOT NULL DEFAULT '0',
  `marauder` tinyint(2) NOT NULL DEFAULT '0',
  `lancer` tinyint(2) NOT NULL DEFAULT '0',
  `archer` tinyint(2) NOT NULL DEFAULT '0',
  `rogue` tinyint(4) NOT NULL DEFAULT '0',
  `conjurer` tinyint(2) NOT NULL DEFAULT '0',
  `thaumaturge` tinyint(2) NOT NULL DEFAULT '0',
  `arcanist` tinyint(2) NOT NULL DEFAULT '0',
  `dark knight` tinyint(2) NOT NULL DEFAULT '0',
  `machinist` tinyint(2) NOT NULL DEFAULT '0',
  `astrologian` tinyint(2) NOT NULL DEFAULT '0',
  `carpenter` tinyint(2) NOT NULL DEFAULT '0',
  `blacksmith` tinyint(2) NOT NULL DEFAULT '0',
  `armorer` tinyint(2) NOT NULL DEFAULT '0',
  `goldsmith` tinyint(2) NOT NULL DEFAULT '0',
  `leatherworker` tinyint(2) NOT NULL DEFAULT '0',
  `weaver` tinyint(2) NOT NULL DEFAULT '0',
  `alchemist` tinyint(2) NOT NULL DEFAULT '0',
  `culinarian` tinyint(2) NOT NULL DEFAULT '0',
  `miner` tinyint(2) NOT NULL DEFAULT '0',
  `botanist` tinyint(2) NOT NULL DEFAULT '0',
  `fisher` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
