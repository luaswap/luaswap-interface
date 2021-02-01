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

/* media-translation-popup.twig */
class __TwigTemplate_60c2dc67ef9be0732c82de07edf01770f80fbbe25f86314656da39b33e107933 extends \WPML\Core\Twig\Template
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
        echo "<div id=\"wpml-media-dialog\">
    <span class=\"ajax-loader\"></span>
    <form id=\"wpml-media-dialog-form\" method=\"post\" enctype=\"multipart/form-data\">
        ";
        // line 4
        echo ($context["nonce"] ?? null);
        echo "
        <input type=\"hidden\" name=\"original-attachment-id\" value=\"\"/>
        <input type=\"hidden\" name=\"translated-attachment-id\" value=\"\"/>
        <input type=\"hidden\" name=\"translated-language\" value=\"\"/>
        <input type=\"hidden\" name=\"restore-media\" value=\"0\"/>
        <input type=\"hidden\" name=\"update-media-file\" value=\"0\"/>
        <input type=\"hidden\" name=\"action\" value=\"wpml_media_save_translation\"/>
        <header class=\"wpml-media-translation-header\">
            <h3 class=\"wpml-header-original\">";
        // line 12
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "original", []), "html", null, true);
        echo "<span class=\"wpml-title-flag\"><img
                            src=\"#\"></span><strong>%from_language%</strong>
            </h3>
            <h3 class=\"wpml-header-translation\">";
        // line 15
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "translation", []), "html", null, true);
        echo "<span class=\"wpml-title-flag\"><img
                            src=\"#\"></span><strong>%to_language%</strong>
            </h3>
        </header>


        <div class=\"wpml-form-row\">

            <label>";
        // line 23
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "file", []), "html", null, true);
        echo "</label>

            <span class=\"wpml-media-wrapper\">
                <span class=\"wpml-media-original-image\">
                    <img src=\"#\" alt=\"#\">
                    <span class=\"wpml-media-original-title\"></span>
                </span>
            </span>

            <span class=\"wpml-media-wrapper wpml-media-upload-handle\">
                <a class=\"wpml-media-translation-image drag-drop-area\">
                    <img src=\"#\" alt=\"#\">
                    <span class=\"wpml-media-translated-title\"></span>
                    <span class=\"wpml-media-upload-text hidden\">";
        // line 36
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "use_different_file", []), "html", null, true);
        echo "</span>
                </a>

                <span class=\"js-wpml-media-revert wpml-display-block text-center hidden\">
                    <a class=\"button button-secondary button-small\">";
        // line 40
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "revert_to_original", []), "html", null, true);
        echo "</a>
                </span>
            </span>

        </div>

        <div class=\"wpml-form-row wpml-form-row-title hidden\">
            <label for=\"media-title\">";
        // line 47
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "name", []), "html", null, true);
        echo "</label>
            <input readonly value=\"\" id=\"media-title-original\" type=\"text\">
            <button class=\"button-copy button-secondary js-button-copy otgs-ico-copy\"
                    title=\"";
        // line 50
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "copy_from_original", []), "html", null, true);
        echo "\"></button>
            <input name=\"translation[title]\" id=\"media-title-translation\" value=\"\" type=\"text\">
        </div>
        <div class=\"wpml-form-row wpml-form-row-caption hidden\">
            <label for=\"media-caption\">";
        // line 54
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "caption", []), "html", null, true);
        echo "</label>
            <textarea readonly id=\"media-caption-original\" cols=\"22\" rows=\"4\"></textarea>
            <button class=\"button-copy button-secondary js-button-copy otgs-ico-copy\"
                    title=\"";
        // line 57
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "copy_from_original", []), "html", null, true);
        echo "\"></button>
            <textarea name=\"translation[caption]\" id=\"media-caption-translation\" cols=\"22\" rows=\"4\"></textarea>
        </div>
        <div class=\"wpml-form-row wpml-form-row-alt-text hidden\">
            <label for=\"media-alt-text\">";
        // line 61
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "alt_text", []), "html", null, true);
        echo "</label>
            <input readonly value=\"\" id=\"media-alt-text-original\" type=\"text\">
            <button class=\"button-copy button-secondary js-button-copy otgs-ico-copy\"
                    title=\"";
        // line 64
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "copy_from_original", []), "html", null, true);
        echo "\"></button>
            <input name=\"translation[alt-text]\" id=\"media-alt-text-translation\" value=\"\" type=\"text\">
        </div>
        <div class=\"wpml-form-row wpml-form-row-description hidden\">
            <label for=\"media-description\">";
        // line 68
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "description", []), "html", null, true);
        echo "</label>
            <textarea readonly id=\"media-description-original\" cols=\"22\" rows=\"4\"></textarea>
            <button class=\"button-copy button-secondary js-button-copy otgs-ico-copy\"
                    title=\"";
        // line 71
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "copy_from_original", []), "html", null, true);
        echo "\"></button>
            <textarea name=\"translation[description]\" id=\"media-description-translation\" cols=\"22\" rows=\"4\"></textarea>
        </div>
    </form>
    ";
        // line 75
        if (($context["show_text_change_notice"] ?? null)) {
            // line 76
            echo "    <div class=\"text-change-notice notice notice-info inline is-dismissible hidden\">
        <p>";
            // line 77
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "texts_change_notice", []), "html", null, true);
            echo "</p>
    </div>
    ";
        }
        // line 80
        echo "    <div id=\"wpml-media-upload-progress-animation\">
        <div class=\"upload-progress-bar\"></div>
        <div class=\"status\">0%</div>
    </div>
    <span id=\"wpml-media-upload-error\" class=\"icl_error_text\"></span>
</div>
<form id=\"wpml-media-file-upload-form\" enctype=\"multipart/form-data\">
    <input type=\"hidden\" name=\"action\" value=\"wpml_media_upload_file\">
    <input type=\"hidden\" name=\"attachment-id\" value=\"\">
    <input type=\"hidden\" name=\"original-attachment-id\" value=\"\">
    <input type=\"hidden\" name=\"language\" value=\"\">
    ";
        // line 91
        echo ($context["nonce"] ?? null);
        echo "
    <input style=\"display:none\" type=\"file\" name=\"image\" accept=\"image/*\" />
</form>
";
    }

    public function getTemplateName()
    {
        return "media-translation-popup.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 91,  161 => 80,  155 => 77,  152 => 76,  150 => 75,  143 => 71,  137 => 68,  130 => 64,  124 => 61,  117 => 57,  111 => 54,  104 => 50,  98 => 47,  88 => 40,  81 => 36,  65 => 23,  54 => 15,  48 => 12,  37 => 4,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "media-translation-popup.twig", "/var/www/new/wp-content/plugins/wpml-media-translation/templates/menus/media-translation-popup.twig");
    }
}
