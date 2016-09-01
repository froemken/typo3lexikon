lib.breadcrumb = HMENU
lib.breadcrumb {
  entryLevel = 0
  special = rootline
  special.range = 0|-1
  wrap = <ol class="breadcrumb">|</ol>

  1 = TMENU
  1.NO {
    doNotLinkIt = |*| 0 |*| 1
    linkWrap = <li>|</li>
  }
  1.CUR = 1
  1.CUR {
    doNotLinkIt = |*| 0 |*| 1
    linkWrap = <li class="active">|</li>
  }
}