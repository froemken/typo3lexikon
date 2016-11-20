page = PAGE
page.typeNum = 0
page.includeJSLibs {
  jQuery = EXT:typo3lexikon/Resources/Public/JavaScript/jquery-2.1.4.min.js
  jQuery.forceOnTop = 1
  bootstrap = EXT:typo3lexikon/Resources/Public/JavaScript/bootstrap.min.js
  main = EXT:typo3lexikon/Resources/Public/JavaScript/main.js
}
page.includeCSS {
  bootstrap = EXT:typo3lexikon/Resources/Public/css/bootstrap.min.css
  main = EXT:typo3lexikon/Resources/Public/css/main.css
  fsCodeSnippetMainLineNUmbers >
  fsCodeSnippetMain = EXT:typo3lexikon/Resources/Public/css/prism-typo3lexikon.css
}

page.10 = FLUIDTEMPLATE
page.10 {
  file = EXT:typo3lexikon/Resources/Private/Templates/Typo3lexikon/Index.html
  partialRootPath = EXT:typo3lexikon/Resources/Private/Partials/
}

#############################
##########  SEO  ############
#############################
#Seitentitel
config.noPageTitle = 2 #Kein Seitentitel. Seitentitel muss manuell erzeugt werden
page.headerData.10 = TEXT
page.headerData.10.field = subtitle // title
page.headerData.10.wrap = <title>|</title>

