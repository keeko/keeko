-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.19-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


USE keeko;

--
-- Dumping data for table `action`
--

/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` (`id`,`module_id`,`name`) VALUES 
 (1,1,'start'),
 (2,1,'login');
/*!40000 ALTER TABLE `action` ENABLE KEYS */;


--
-- Dumping data for table `block`
--

/*!40000 ALTER TABLE `block` DISABLE KEYS */;
/*!40000 ALTER TABLE `block` ENABLE KEYS */;


--
-- Dumping data for table `block_action`
--

/*!40000 ALTER TABLE `block_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `block_action` ENABLE KEYS */;


--
-- Dumping data for table `grid`
--

/*!40000 ALTER TABLE `grid` DISABLE KEYS */;
/*!40000 ALTER TABLE `grid` ENABLE KEYS */;


--
-- Dumping data for table `language`
--

/*!40000 ALTER TABLE `language` DISABLE KEYS */;
/*!40000 ALTER TABLE `language` ENABLE KEYS */;


--
-- Dumping data for table `language_text`
--

/*!40000 ALTER TABLE `language_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `language_text` ENABLE KEYS */;


--
-- Dumping data for table `layout`
--

/*!40000 ALTER TABLE `layout` DISABLE KEYS */;
/*!40000 ALTER TABLE `layout` ENABLE KEYS */;


--
-- Dumping data for table `layout_grid`
--

/*!40000 ALTER TABLE `layout_grid` DISABLE KEYS */;
/*!40000 ALTER TABLE `layout_grid` ENABLE KEYS */;


--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`,`unit_id`,`block_id`,`name`,`is_admin`) VALUES 
 (1,NULL,NULL,'admin',1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Dumping data for table `menu_item`
--

/*!40000 ALTER TABLE `menu_item` DISABLE KEYS */;
INSERT INTO `menu_item` (`id`,`parent_id`,`menu_id`,`text_id`,`page_id`,`module_id`,`action_id`,`event`,`image`) VALUES 
 (1,0,1,1,NULL,1,1,1,''),
 (2,0,1,2,NULL,NULL,NULL,1,NULL),
 (3,0,1,3,NULL,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `menu_item` ENABLE KEYS */;


--
-- Dumping data for table `module`
--

/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`id`,`unixname`,`version`) VALUES 
 (1,'AdminHome','0.1');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;


--
-- Dumping data for table `page`
--

/*!40000 ALTER TABLE `page` DISABLE KEYS */;
/*!40000 ALTER TABLE `page` ENABLE KEYS */;


--
-- Dumping data for table `page_css`
--

/*!40000 ALTER TABLE `page_css` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_css` ENABLE KEYS */;


--
-- Dumping data for table `page_js`
--

/*!40000 ALTER TABLE `page_js` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_js` ENABLE KEYS */;


--
-- Dumping data for table `page_permission`
--

/*!40000 ALTER TABLE `page_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_permission` ENABLE KEYS */;


--
-- Dumping data for table `param`
--

/*!40000 ALTER TABLE `param` DISABLE KEYS */;
/*!40000 ALTER TABLE `param` ENABLE KEYS */;


--
-- Dumping data for table `role`
--

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`,`user_id`,`name`,`is_guest`,`is_default`) VALUES 
 (1,0,'Guest',1,NULL),
 (2,0,'User',NULL,1),
 (3,0,'Admin',NULL,NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


--
-- Dumping data for table `role_action`
--

/*!40000 ALTER TABLE `role_action` DISABLE KEYS */;
INSERT INTO `role_action` (`action_id`,`role_id`) VALUES 
 (1,3),
 (2,1);
/*!40000 ALTER TABLE `role_action` ENABLE KEYS */;


--
-- Dumping data for table `role_user`
--

/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`,`role_id`) VALUES 
 (1,2),
 (1,3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;


--
-- Dumping data for table `setting`
--

/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`keyname`,`cat_id`,`section_id`,`module_id`,`value`,`format`,`hide`) VALUES 
 ('admin_design',0,0,0,'whiteglass',NULL,1);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;


--
-- Dumping data for table `setting_cat`
--

/*!40000 ALTER TABLE `setting_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `setting_cat` ENABLE KEYS */;


--
-- Dumping data for table `setting_section`
--

/*!40000 ALTER TABLE `setting_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `setting_section` ENABLE KEYS */;


--
-- Dumping data for table `unit`
--

/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;


--
-- Dumping data for table `unit_action`
--

/*!40000 ALTER TABLE `unit_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_action` ENABLE KEYS */;


--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`name`,`passwd`,`first_name`,`last_name`,`birth`,`created`,`email`,`gender`) VALUES 
 (1,'root','63a9f0ea7bb98050796b649e85481845',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


--
-- Dumping data for table `user_ext`
--

/*!40000 ALTER TABLE `user_ext` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_ext` ENABLE KEYS */;


--
-- Dumping data for table `user_ext_cat`
--

/*!40000 ALTER TABLE `user_ext_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_ext_cat` ENABLE KEYS */;


--
-- Dumping data for table `user_ext_val`
--

/*!40000 ALTER TABLE `user_ext_val` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_ext_val` ENABLE KEYS */;


--
-- Dumping data for table `user_setting`
--

/*!40000 ALTER TABLE `user_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_setting` ENABLE KEYS */;


--
-- Dumping data for table `user_setting_value`
--

/*!40000 ALTER TABLE `user_setting_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_setting_value` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
