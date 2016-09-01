RTE.config.tt_content.bodytext.proc.overruleMode = css_transform,code
RTE.config.tt_content.bodytext.types.text.proc.overruleMode = css_transform,code
RTE.config.tt_content.bodytext.types.textpic.proc.overruleMode = css_transform,code

RTE.default >
RTE.classes >

RTE.default {
  showButtons = blockstylelabel, blockstyle, textstylelabel, textstyle, formatblock, bold, italic, underline, chMode, link, unorderedlist, textcolor, user
  contentCSS = EXT:typo3lexikon/Resources/Public/css/rte.css
  buttons {
    formatblock {
      removeItems = article,section,footer,header,nav,aside,h5,h6,address
    }
  }
  keepButtonGroupTogether = 1
  classesAnchor = internal-link,external-link,internal-link-new-window,external-link-new-window,download,email
  classesAnchor.default {
    page = internal-link
    url = external-link-new-window
    file = download
    mail = email
  }
  proc {
    overrideMode = css_transform,code
    #allowTags = b,i,u,a,img,br,div,center,pre,font,hr,sub,sup,p,strong,em,li,ul,ol,blockquote,strike,span
    denyTags = img,center,font,hr,sub,sup,ol,strike
    dontUndoHSC_db = 1
    dontHSC_rte = 1
    dontConvBRtoParagraph = 1
    exitHTMLparser_db = 1
    exitHTMLparser_db {
      allowTags = p,div,b,strong,i,em,u,h1,h2,h3,h4,div,pre,code,blockquote,ul,li,a,link,br
      tags {
        b.remap = strong
        i.remap = em
      }
    }
    exitHTMLparser_rte = 1
    exitHTMLparser_rte {
      allowTags = p,div,b,strong,i,em,u,h1,h2,h3,h4,div,pre,code,blockquote,ul,li,a,link,br
      htmlSpecialChars = 0
      tags {
        strong.remap = b
        em.remap = i
      }
    }
  }
  # Add user elements for Prismjs Syntax Highlight
  userElements {
    10 = Prismjs Syntax-Highlight
    10 {
      10 = HTML
      10.description = Markup/HTML
      10.mode = wrap
      10.content = <pre><code class="language-markup">|</code></pre>
      20 = CSS
      20.description = Highlight von CSS
      20.mode = wrap
      20.content = <pre><code class="language-css">|</code></pre>
      30 = JS
      30.description = JavaScript
      30.mode = wrap
      30.content = <pre><code class="language-javascript">|</code></pre>
      40 = PHP
      40.description = Highlight von PHP-Quellcode
      40.mode = wrap
      40.content = <pre><code class="language-php">|</code></pre>
      50 = SQL
      50.description = Structured Query Language
      50.mode = wrap
      50.content = <pre><code class="language-sql">|</code></pre>
      60 = YAML
      60.description = Yust Another Markup Language
      60.mode = wrap
      60.content = <pre><code class="language-yaml">|</code></pre>
      70 = Bash
      70.description = Highlight von Linux Bash-Befehlen
      70.mode = wrap
      70.content = <pre><code class="language-bash">|</code></pre>
    }
  }
}

RTE.classes {
  text-primary {
    name = Primary
    value = color: #f2914f;
  }
  text-success {
    name = Success
    value = color: #3c763d;
  }
  text-info {
    name = Info
    value = color: #31708f;
  }
  text-warning {
    name = Warning
    value = color: #8a6d3b;
  }
  text-danger {
    name = Danger
    value = color: #a94442;
  }

  bg-primary {
    name = Background: Primary
    value = background-color: #f2914f; color: #fff;
  }
  bg-success {
    name = Background: Success
    value = background-color: #dff0d8;
  }
  bg-info {
    name = Background: Info
    value = background-color: #d9edf7;
  }
  bg-warning {
    name = Background: Warning
    value = background-color: #fcf8e3;
  }
  bg-danger {
    name = Background: Danger
    value = background-color: #f2dede;
  }

  alert {
    noShow = 1
  }
  alert-success {
    name = Alert: Success
    value = background-color: #dff0d8; border-color: #d6e9c6; color: #3c763d;
    requires = alert
  }
  alert-info {
    name = Alert: Info
    value = background-color: #d9edf7; border-color: #bce8f1; color: #31708f;
    requires = alert
  }
  alert-warning {
    name = Alert: Warning
    value = background-color: #fcf8e3; border-color: #faebcc; color: #8a6d3b;
    requires = alert
  }
  alert-danger {
    name = Alert: Danger
    value = background-color: #f2dede; border-color: #ebccd1; color: #a94442;
    requires = alert
  }
}