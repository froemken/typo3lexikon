config {
	# Deactivate Exception Handler to show something other than only: Oops an Error occurred
	contentObjectExceptionHandler = 0

	# html5 is the default
	doctype = html5

	# concatenation and compression
	concatenateCss = 1
	concatenateJs = 1
	compressJs = 1
	compressCss = 1

	# if a page is cached and no user is logged in, TYPO3 sends valid cache headers to store files on client
	# Maybe I change that with help of .htaccess in future
	sendCacheHeaders = 1

	# do not clear cache each day. Clear cache only each month
	cache_period = 2592000

	# RealURL
	simulateStaticDocuments = 0
	absRefPrefix = auto
	tx_realurl_enable = 1

	# Localization
	language = de
	locale_all = de_DE.UTF-8
	htmlTag_langKey = de
	sys_language_uid = 0

	# Spam Protection
	spamProtectEmailAddresses = -5
	notification_email_urlmode = 76
}
