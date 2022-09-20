DROP DATABASE IF EXISTS `blogsystem`;


CREATE DATABASE `blogsystem`;

USE `blogsystem`;


#
# Table structure for table 'user'
#
CREATE TABLE user (
	id int(11) unsigned NOT NULL auto_increment,
	firstname varchar(255) DEFAULT '' NOT NULL,
	lastname varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	tags int(11) unsigned DEFAULT '0' NOT NULL,
	role enum('Administrator','blogger','commentator'),
	tags_special int(11) unsigned DEFAULT '0' NOT NULL,
	PRIMARY KEY (id)
);

#
# Table structure for table 'blog'
#
CREATE TABLE blog (
	id int(11) unsigned NOT NULL auto_increment,
	title varchar(255) DEFAULT '' NOT NULL,
	subtitle varchar(255) DEFAULT '',
	description text NOT NULL,
	logo tinyblob NOT NULL,
	administrator int(11) DEFAULT '0' NOT NULL,
	posts varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (id)
);

#
# Table structure for table 'post'
#
CREATE TABLE post (
	id int(11) unsigned NOT NULL auto_increment,
	blog_id int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	date_post int(11) DEFAULT '0' NOT NULL,
	author int(11) unsigned DEFAULT '0' NOT NULL,
	second_author int(11) DEFAULT '0' NOT NULL,
	reviewer int(11) DEFAULT '0' NOT NULL,
	content text NOT NULL,
	tags int(11) unsigned DEFAULT '0' NOT NULL,
	comments int(11) unsigned DEFAULT '0' NOT NULL,
	related_posts int(11) unsigned DEFAULT '0' NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY fk_blog_id_post_id (blog_id) REFERENCES blog (id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY fk_user_id_post_id (author) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
	
);

#
# Table structure for table 'comment'
#
CREATE TABLE comment (
	id int(11) unsigned NOT NULL auto_increment,
	post_id int(11) unsigned DEFAULT '0' NOT NULL,
	date_comment datetime,
	author varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	content text NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY fk_post_id_comment_id (post_id) REFERENCES post (id) ON DELETE CASCADE ON UPDATE CASCADE
);


#
# Table structure for table 'tag'
#
CREATE TABLE tag (
	id int(11) unsigned NOT NULL auto_increment,
	name varchar(255) DEFAULT '' NOT NULL,
	posts int(11) unsigned DEFAULT '0' NOT NULL,
	PRIMARY KEY (id)
);

#
# Table structure for table 'tag_mm'
#
CREATE TABLE tag_mm (
	id_local int(11) unsigned DEFAULT '0' NOT NULL,
	id_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	tablenames varchar(255) DEFAULT '' NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY id_local (id_local),
	KEY id_foreign (id_foreign)
);

#
# Table structure for table 'post_tag_mm'
#
CREATE TABLE post_tag_mm (
	id_post int(11) unsigned DEFAULT '0' NOT NULL,
	id_tag int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	FOREIGN KEY fk_post_id_id_post (id_post) REFERENCES post (id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY fk_tag_id_id_tag (id_tag) REFERENCES tag (id) ON DELETE CASCADE ON UPDATE CASCADE
);

