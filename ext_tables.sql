#
# Table structure for table 'tx_news_domain_model_news '
#
CREATE TABLE tx_news_domain_model_news
(
	layout  varchar(50)      DEFAULT '' NOT NULL,
	gallery int(11) unsigned DEFAULT '0'
);

CREATE TABLE tt_content
(
	tx_newslayouts_dummyimage int(11) unsigned DEFAULT '0'
);
