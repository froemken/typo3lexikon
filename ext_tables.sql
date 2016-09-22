#
# Table structure for table 'tx_typo3lexikon_answer'
#
CREATE TABLE tx_typo3lexikon_answer (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	answer varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_typo3lexikon_word'
#
CREATE TABLE tx_typo3lexikon_word (
	uid int(11) NOT NULL auto_increment,
	word varchar(50) DEFAULT '' NOT NULL,
	PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_typo3lexikon_answer_word_mm'
#
CREATE TABLE tx_typo3lexikon_answer_word_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
