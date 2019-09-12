<?php

/**
 * @package    Plugin
 * @subpackage Linkchecker
 * @author     Mario Diaz
 * @copyright  four for business AG <www.4fb.de>
 * @license    http://www.contenido.org/license/LIZENZ.txt
 * @link       http://www.4fb.de
 * @link       http://www.contenido.org
 */

defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

/**
 * Class searchLinks
 */
class cLinkcheckerSearchLinks
{
    /**
     * @var string
     */
    private $mode = '';

    /**
     * cLinkcheckerSearchLinks constructor.
     */
    public function __construct()
    {
        $this->setMode("text");
    }

    /**
     * Setter method for mode
     *
     * mode:
     * - text (standard)
     * - redirect
     *
     * @param $mode
     *
     * @return mixed
     */
    public function setMode($mode)
    {
        return $this->mode = cSecurity::toString($mode);
    }

    /**
     * Searchs extern and intern links.
     *
     * @todo Optimize this function!
     * @todo Do not use global!
     *
     * @param string $value
     * @param int    $idart
     * @param string $nameart
     * @param int    $idcat
     * @param string $namecat
     * @param int    $idlang
     * @param int    $idartlang
     * @param int    $idcontent
     *
     * @return array
     */
    public function search($value, $idart, $nameart, $idcat, $namecat, $idlang, $idartlang, $idcontent = 0)
    {
        global $aUrl, $aSearchIDInfosNonID, $aWhitelist;

        // Extern URL
        if (preg_match_all('~(?:(?:action|data|href|src)=["\']((?:file|ftp|http|ww)[^\s]*)["\'])~i', $value, $aMatches)
            && $_GET['mode'] != 1
        ) {
            for ($i = 0; $i < count($aMatches[1]); $i++) {
                if (!in_array($aMatches[1][$i], $aWhitelist)) {
                    $aSearchIDInfosNonID[] = [
                        "url"       => $aMatches[1][$i],
                        "idart"     => $idart,
                        "nameart"   => $nameart,
                        "idcat"     => $idcat,
                        "namecat"   => $namecat,
                        "idcontent" => $idcontent,
                        "idartlang" => $idartlang,
                        "lang"      => $idlang,
                        "urltype"   => "extern",
                    ];
                }
            }
        }

        // Redirect
        if ($this->mode == "redirect"
            && (preg_match('!(' . preg_quote($aUrl['cms']) . '[^\s]*)!i', $value, $aMatches)
                || (preg_match('~(?:file|ftp|http|ww)[^\s]*~i', $value, $aMatches) && $_GET['mode'] != 1))
            && (cString::findFirstPosCI($value, 'front_content.php') === false)
            && !in_array($aMatches[0], $aWhitelist)
        ) {
            $aSearchIDInfosNonID[] = [
                "url"       => $aMatches[0],
                "idart"     => $idart,
                "nameart"   => $nameart,
                "idcat"     => $idcat,
                "namecat"   => $namecat,
                "idcontent" => 0,
                "idartlang" => $idartlang,
                "lang"      => $idlang,
                "urltype"   => "unknown",
                "redirect"  => true,
            ];
        }

        // Intern URL
        if (preg_match_all(
                '~(?:(?:action|data|href|src)=["\'])(?!file://)(?!ftp://)(?!http://)(?!https://)(?!ww)(?!mailto)(?!\#)(?!/\#)([^"\']+)(?:["\'])~i',
                $value,
                $aMatches
            )
            && $_GET['mode'] != 2
        ) {
            for ($i = 0; $i < count($aMatches[1]); $i++) {
                if (cString::findFirstPos($aMatches[1][$i], "front_content.php") === false
                    && !in_array(
                        $aMatches[1][$i],
                        $aWhitelist
                    )
                ) {
                    $aSearchIDInfosNonID[] = [
                        "url"       => $aMatches[1][$i],
                        "idart"     => $idart,
                        "nameart"   => $nameart,
                        "idcat"     => $idcat,
                        "namecat"   => $namecat,
                        "idcontent" => $idcontent,
                        "idartlang" => $idartlang,
                        "lang"      => $idlang,
                        "urltype"   => "intern",
                    ];
                }
            }
        }

        return $aSearchIDInfosNonID;
    }
}
