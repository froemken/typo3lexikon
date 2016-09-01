lib.leftNavigation = COA
lib.leftNavigation {
  10 = HMENU
  10 {
    entryLevel = 0

    # erstes level
    1 = TMENU
    1.wrap = <nav><ul class="nav nav-pills nav-stacked">|</ul></nav>
    1 {
      # no state: normale Formatierung
      NO {
        wrapItemAndSub = <li>|</li>
      }
      RO {
        wrapItemAndSub = <li>|</li>
      }

      # act state: gültig von der rootseite bis zur aktuellen Seite
      ACT = 1
      ACT {
        wrapItemAndSub = <li class="active">|</li>
      }
    }
  }
}