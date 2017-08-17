page = PAGE
page.typeNum = 0

page.includeJSFooter {
  jQuery = https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js
  jQuery.external = 1
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
  variables {
    searchPage = TEXT
    searchPage.typolink.parameter = 277
    searchPage.typolink.returnLast = url
  }
}

#############################
##########  SEO  ############
#############################
#Seitentitel
config.noPageTitle = 2 #Kein Seitentitel. Seitentitel muss manuell erzeugt werden
page.headerData.10 = TEXT
page.headerData.10.field = subtitle // title
page.headerData.10.wrap = <title>|</title>

