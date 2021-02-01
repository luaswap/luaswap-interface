<?php

namespace WPML\Core;

use \WPML\Core\Twig\Environment;
use \WPML\Core\Twig\Error\LoaderError;
use \WPML\Core\Twig\Error\RuntimeError;
use \WPML\Core\Twig\Markup;
use \WPML\Core\Twig\Sandbox\SecurityError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use \WPML\Core\Twig\Source;
use \WPML\Core\Twig\Template;

/* layout-main.twig */
class __TwigTemplate_14a20320728b579040a4220b11f448f58b82d55177d005acfa99de229ba79096 extends \WPML\Core\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<form id=\"wpml-ls-settings-form\" name=\"wpml_ls_settings_form\">

\t<input type=\"hidden\" name=\"wpml-ls-refresh-on-browser-back-button\" id=\"wpml-ls-refresh-on-browser-back-button\" value=\"no\">

    ";
        // line 5
        if ($this->getAttribute(($context["notifications"] ?? null), "css_not_loaded", [])) {
            // line 6
            echo "        <div class=\"wpml-ls-message notice notice-info\">
            <p>";
            // line 7
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["notifications"] ?? null), "css_not_loaded", []), "html", null, true);
            echo "</p>
        </div>
    ";
        }
        // line 10
        echo "
    <div id=\"wpml-language-switcher-options\" class=\"js-wpml-ls-section wpml-section\">
        <div class=\"wpml-section-header\">
            <h3>";
        // line 13
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "section_title", []), "html", null, true);
        echo "</h3>
\t\t\t<p>";
        // line 14
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "section_description", []), "html", null, true);
        echo "</p>
        </div>

        <div class=\"js-setting-group wpml-ls-settings-group wpml-section-content\">
            ";
        // line 18
        $this->loadTemplate("section-options.twig", "layout-main.twig", 18)->display($context);
        // line 19
        echo "        </div>
    </div>

    <div id=\"wpml-language-switcher-menus\" class=\"js-wpml-ls-section wpml-section\">
        <div class=\"wpml-section-header\">
            <h3>
                ";
        // line 25
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "menus", []), "section_title", []), "html", null, true);
        echo "
            </h3>
            ";
        // line 27
        $this->loadTemplate("save-notification.twig", "layout-main.twig", 27)->display($context);
        // line 28
        echo "        </div>

        <div class=\"js-setting-group wpml-ls-settings-group wpml-section-content\">
            ";
        // line 31
        $this->loadTemplate("section-menus.twig", "layout-main.twig", 31)->display($context);
        // line 32
        echo "        </div>
    </div>

    <div id=\"wpml-language-switcher-sidebars\" class=\"js-wpml-ls-section wpml-section\">
        <div class=\"wpml-section-header\">
            <h3>
                ";
        // line 38
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "sidebars", []), "section_title", []), "html", null, true);
        echo "
            </h3>
            ";
        // line 40
        $this->loadTemplate("save-notification.twig", "layout-main.twig", 40)->display($context);
        // line 41
        echo "        </div>

        <div class=\"js-setting-group wpml-ls-settings-group wpml-section-content\">
            ";
        // line 44
        $this->loadTemplate("section-sidebars.twig", "layout-main.twig", 44)->display($context);
        // line 45
        echo "        </div>
    </div>

    <div id=\"wpml-language-switcher-footer\" class=\"js-wpml-ls-section wpml-section\">
        <div class=\"wpml-section-header\">
            <h3>
                ";
        // line 51
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "footer", []), "section_title", []), "html", null, true);
        echo "
                ";
        // line 52
        $this->loadTemplate("tooltip.twig", "layout-main.twig", 52)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "show_in_footer", [])]));
        // line 53
        echo "            </h3>
        </div>

        <div class=\"js-setting-group wpml-ls-settings-group wpml-section-content\">
            ";
        // line 57
        $this->loadTemplate("section-footer.twig", "layout-main.twig", 57)->display($context);
        // line 58
        echo "        </div>

    </div>

    <div id=\"wpml-language-switcher-post-translations\" class=\"js-wpml-ls-section wpml-section\">
        <div class=\"wpml-section-header\">
            <h3>
                ";
        // line 65
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "section_title", []), "html", null, true);
        echo "
                ";
        // line 66
        $this->loadTemplate("tooltip.twig", "layout-main.twig", 66)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "section_post_translations", [])]));
        // line 67
        echo "            </h3>
        </div>

        <div class=\"js-setting-group wpml-ls-settings-group wpml-section-content\">
            ";
        // line 71
        $this->loadTemplate("section-post-translations.twig", "layout-main.twig", 71)->display($context);
        // line 72
        echo "        </div>
    </div>

    <div id=\"wpml-language-switcher-shortcode-action\" class=\"js-wpml-ls-section wpml-section\"
        ";
        // line 76
        if ( !($context["setup_complete"] ?? null)) {
            echo " style=\"display:none;\"";
        }
        echo ">
        <div class=\"wpml-section-header\">
            <h3>
                ";
        // line 79
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "shortcode_actions", []), "section_title", []), "html", null, true);
        echo "
                ";
        // line 81
        echo "            </h3>
            ";
        // line 82
        $this->loadTemplate("save-notification.twig", "layout-main.twig", 82)->display($context);
        // line 83
        echo "        </div>

        <div class=\"js-setting-group wpml-ls-settings-group wpml-section-content\">
            ";
        // line 86
        $this->loadTemplate("section-shortcode-action.twig", "layout-main.twig", 86)->display($context);
        // line 87
        echo "        </div>
    </div>

    ";
        // line 90
        $this->loadTemplate("setup-wizard-buttons.twig", "layout-main.twig", 90)->display($context);
        // line 91
        echo "
    ";
        // line 92
        $this->loadTemplate("dialog-box.twig", "layout-main.twig", 92)->display($context);
        // line 93
        echo "
</form>";
    }

    public function getTemplateName()
    {
        return "layout-main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 93,  196 => 92,  193 => 91,  191 => 90,  186 => 87,  184 => 86,  179 => 83,  177 => 82,  174 => 81,  170 => 79,  162 => 76,  156 => 72,  154 => 71,  148 => 67,  146 => 66,  142 => 65,  133 => 58,  131 => 57,  125 => 53,  123 => 52,  119 => 51,  111 => 45,  109 => 44,  104 => 41,  102 => 40,  97 => 38,  89 => 32,  87 => 31,  82 => 28,  80 => 27,  75 => 25,  67 => 19,  65 => 18,  58 => 14,  54 => 13,  49 => 10,  43 => 7,  40 => 6,  38 => 5,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "layout-main.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/layout-main.twig");
    }
}
