#RTE configuration
RTE.default >

RTE.default {
  tinymceConfiguration = EXT:typo3lexikon/Resources/Public/TinyMCE/config.js
  disableEnterParagraphs = 1
  classesAnchor = internal-link,external-link,internal-link-new-window,external-link-new-window,download,email
  classesAnchor.default {
    page = internal-link
    url = external-link-new-window
    file = download
    mail = email
  }
  proc {
    overrideMode = css_transform
    #allowTags = b,i,u,a,img,br,div,center,pre,font,hr,sub,sup,p,strong,em,li,ul,ol,blockquote,strike,span
    denyTags = img,center,font,hr,sub,sup,ol,strike
    #dontUndoHSC_db = 1
    #dontHSC_rte = 1
    dontConvBRtoParagraph = 1
    exitHTMLparser_db = 1
    exitHTMLparser_db {
      allowTags = p,b,strong,i,em,u,h2,h3,pre,ul,li,a,link,br,span
      tags {
        b {
          allowedAttribs = 0
          remap = strong
        }
        strong {
          allowedAttribs = 0
          remap = strong
        }
        i {
          allowedAttribs = 0
          remap = em
        }
        em {
          allowedAttribs = 0
          remap = em
        }
        p {
          allowedAttribs = class
        }
        h2 {
          allowedAttribs = 0
        }
        h3 {
          allowedAttribs = 0
        }
        ul {
          allowedAttribs = 0
        }
        li {
          allowedAttribs = 0
        }
        span {
          allowedAttribs = style, class
          fixAttrib.style.list = text-decoration: underline;
        }
      }
    }
    exitHTMLparser_rte = 1
    exitHTMLparser_rte {
      allowTags = p,strong,em,u,h2,h3,pre,ul,li,a,br,span
    }
  }
}
