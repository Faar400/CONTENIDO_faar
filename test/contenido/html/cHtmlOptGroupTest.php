<?PHP

/**
 * @package    Testing
 * @subpackage GUI_HTML
 * @author     claus.schunk@4fb.de
 * @copyright  four for business AG <www.4fb.de>
 * @license    https://www.contenido.org/license/LIZENZ.txt
 * @link       https://www.4fb.de
 * @link       https://www.contenido.org
 */
class cHtmlOptGroupTest extends cTestingTestCase
{
    public function testConstruct()
    {
        $opt = new cHTMLOptgroup('testContent', 'testClass', 'testId');
        $this->assertSame('<optgroups id="testId" class="testClass">testContent</optgroups>', $opt->toHtml());
        $opt = new cHTMLOptgroup('', '', 'testId2');
        $this->assertSame('<optgroups id="testId2"></optgroups>', $opt->toHtml());
    }
}
