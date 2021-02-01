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

/* section-options.twig */
class __TwigTemplate_1a2173b23cd5926c6f4fb666720445df30eb816f3c171096cda324280b6895d9 extends \WPML\Core\Twig\Template
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
        echo "<div class=\"js-wpml-ls-option wpml-ls-language_order\">
\t<h4><label>";
        // line 2
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "label_language_order", []), "html", null, true);
        echo "</label> ";
        $this->loadTemplate("tooltip.twig", "section-options.twig", 2)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "languages_order", [])]));
        // line 3
        echo "\t\t";
        $this->loadTemplate("save-notification.twig", "section-options.twig", 3)->display($context);
        // line 4
        echo "\t</h4>
\t<p class=\"explanation-text\">";
        // line 5
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "tip_drag_languages", []), "html", null, true);
        echo "</p>
\t<ul id=\"wpml-ls-languages-order\" class=\"wpml-ls-languages-order\">
\t\t";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["ordered_languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 8
            echo "\t\t<li class=\"js-wpml-languages-order-item\" data-language-code=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "code", []), "html", null, true);
            echo "\">
\t\t\t<img width=\"18\" height=\"12\" src=\"";
            // line 9
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "flag_url", []), "html", null, true);
            echo "\"> ";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "display_name", []), "html", null, true);
            echo "<input type=\"hidden\" name=\"languages_order[]\" value=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "code", []), "html", null, true);
            echo "\">
\t\t</li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "\t</ul>
</div>

<div class=\"js-wpml-ls-option wpml-ls-languages_with_no_translations\">
\t<h4><label>";
        // line 16
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "label_languages_with_no_translations", []), "html", null, true);
        echo " ";
        $this->loadTemplate("tooltip.twig", "section-options.twig", 16)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "languages_without_translation", [])]));
        // line 17
        echo "\t\t</label>
\t\t";
        // line 18
        $this->loadTemplate("save-notification.twig", "section-options.twig", 18)->display($context);
        // line 19
        echo "\t</h4>
\t<ul>
\t\t<li>
\t\t\t<label for=\"link_empty_off\">
\t\t\t\t<input type=\"radio\" name=\"link_empty\" id=\"link_empty_off\"
\t\t\t\t\t   class=\"js-wpml-ls-trigger-save\"
\t\t\t\t\t   value=\"0\"";
        // line 25
        if ( !$this->getAttribute(($context["settings"] ?? null), "link_empty", [])) {
            echo " checked=\"checked\"";
        }
        echo ">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "option_skip_link", []), "html", null, true);
        echo "
\t\t\t</label>
\t\t</li>
\t\t<li>
\t\t\t<label for=\"link_empty_on\">
\t\t\t\t<input type=\"radio\" name=\"link_empty\" id=\"link_empty_on\"
\t\t\t\t\t   class=\"js-wpml-ls-trigger-save\"
\t\t\t\t\t   value=\"1\"";
        // line 32
        if ($this->getAttribute(($context["settings"] ?? null), "link_empty", [])) {
            echo " checked=\"checked\"";
        }
        echo ">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "option_link_home", []), "html", null, true);
        echo "
\t\t\t</label>
\t\t</li>
\t</ul>
</div>

<div class=\"js-wpml-ls-option wpml-ls-preserve_url_args\">
\t<p class=\"wpml-ls-form-line\">
\t\t";
        // line 40
        if ( !$this->getAttribute(($context["settings"] ?? null), "copy_parameters", [])) {
            echo "<a href=\"#\" class=\"js-wpml-ls-toggle-once\">";
        }
        // line 41
        echo "\t\t\t<label for=\"copy_parameters\">
\t\t\t\t";
        // line 42
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "label_preserve_url_args", []), "html", null, true);
        if ( !$this->getAttribute(($context["settings"] ?? null), "copy_parameters", [])) {
            echo "<span class=\"otgs-ico-caret-down js-arrow-toggle\"></span>";
        }
        // line 43
        echo "</label>";
        if ( !$this->getAttribute(($context["settings"] ?? null), "copy_parameters", [])) {
            echo "</a>";
        }
        // line 44
        echo "
\t\t";
        // line 45
        $this->loadTemplate("tooltip.twig", "section-options.twig", 45)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "preserve_url_arguments", [])]));
        // line 46
        echo "
\t\t";
        // line 47
        $this->loadTemplate("save-notification.twig", "section-options.twig", 47)->display($context);
        // line 48
        echo "
\t\t<input type=\"text\" size=\"100\" id=\"copy_parameters\" name=\"copy_parameters\"
\t\t\t   value=\"";
        // line 50
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "copy_parameters", []), "html", null, true);
        echo "\"
\t\t\t   class=\"js-wpml-ls-trigger-save js-wpml-ls-trigger-need-save";
        // line 51
        if ( !$this->getAttribute(($context["settings"] ?? null), "copy_parameters", [])) {
            echo " js-wpml-ls-toggle-target hidden";
        }
        echo "\">
\t</p>
</div>

<div class=\"js-wpml-ls-option wpml-ls-additional_css\">
\t<p class=\"wpml-ls-form-line\">
\t\t";
        // line 57
        if ( !$this->getAttribute(($context["settings"] ?? null), "additional_css", [])) {
            echo "<a href=\"#\" class=\"js-wpml-ls-toggle-once\">";
        }
        // line 58
        echo "\t\t\t<label for=\"additional_css\">
\t\t\t\t";
        // line 59
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "label_additional_css", []), "html", null, true);
        if ( !$this->getAttribute(($context["settings"] ?? null), "additional_css", [])) {
            echo "<span class=\"otgs-ico-caret-down js-arrow-toggle\"></span>";
        }
        // line 60
        echo "</label>";
        if ( !$this->getAttribute(($context["settings"] ?? null), "additional_css", [])) {
            echo "</a>";
        }
        // line 61
        echo "

\t\t";
        // line 63
        $this->loadTemplate("tooltip.twig", "section-options.twig", 63)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "additional_css", [])]));
        // line 64
        echo "
\t\t";
        // line 65
        $this->loadTemplate("save-notification.twig", "section-options.twig", 65)->display($context);
        // line 66
        echo "
\t\t<textarea id=\"additional_css\" name=\"additional_css\" rows=\"4\"
\t\t\t\t  class=\"large-text js-wpml-ls-additional-css js-wpml-ls-trigger-save js-wpml-ls-trigger-need-save";
        // line 68
        if ( !$this->getAttribute(($context["settings"] ?? null), "additional_css", [])) {
            echo " js-wpml-ls-toggle-target hidden";
        }
        echo "\">";
        // line 69
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["settings"] ?? null), "additional_css", []), "html", null, true);
        // line 70
        echo "</textarea>
\t</p>
</div>

<div class=\"js-wpml-ls-option wpml-ls-backwards_compatibility\">
\t<div class=\"wpml-ls-form-line\">
\t\t";
        // line 76
        if (( !$this->getAttribute(($context["settings"] ?? null), "migrated", []) == 1)) {
            // line 77
            echo "\t\t\t";
            $context["hide_backwards_compatibility"] = true;
            // line 78
            echo "\t\t";
        }
        // line 79
        echo "
\t\t";
        // line 80
        if (($context["hide_backwards_compatibility"] ?? null)) {
            echo "<a href=\"#\" class=\"js-wpml-ls-toggle-once\">";
        }
        // line 81
        echo "\t\t\t<label>
\t\t\t\t";
        // line 82
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "label_migrated_toggle", []), "html", null, true);
        if (($context["hide_backwards_compatibility"] ?? null)) {
            echo "<span class=\"otgs-ico-caret-down js-arrow-toggle\"></span>";
        }
        // line 83
        echo "</label>";
        if (($context["hide_backwards_compatibility"] ?? null)) {
            echo "</a>";
        }
        // line 84
        echo "
\t\t";
        // line 85
        $this->loadTemplate("tooltip.twig", "section-options.twig", 85)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "backwards_compatibility", [])]));
        // line 86
        echo "
\t\t";
        // line 87
        $this->loadTemplate("save-notification.twig", "section-options.twig", 87)->display($context);
        // line 88
        echo "
\t\t<p";
        // line 89
        if (($context["hide_backwards_compatibility"] ?? null)) {
            echo " class=\"js-wpml-ls-toggle-target hidden\"";
        }
        echo ">
\t\t\t<input type=\"checkbox\" id=\"wpml-ls-backwards-compatibility\" name=\"migrated\"
\t\t\t\t   value=\"0\"";
        // line 91
        if (($this->getAttribute(($context["settings"] ?? null), "migrated", []) == 0)) {
            echo " checked=\"checked\"";
        }
        // line 92
        echo "\t\t\t\t   class=\"js-wpml-ls-migrated js-wpml-ls-trigger-save js-wpml-ls-trigger-need-save\">

\t\t\t<label for=\"wpml-ls-backwards-compatibility\">
\t\t\t\t";
        // line 95
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "options", []), "label_skip_backwards_compatibility", []), "html", null, true);
        echo "
\t\t\t</label>
\t\t</p>

\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "section-options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  274 => 95,  269 => 92,  265 => 91,  258 => 89,  255 => 88,  253 => 87,  250 => 86,  248 => 85,  245 => 84,  240 => 83,  235 => 82,  232 => 81,  228 => 80,  225 => 79,  222 => 78,  219 => 77,  217 => 76,  209 => 70,  207 => 69,  202 => 68,  198 => 66,  196 => 65,  193 => 64,  191 => 63,  187 => 61,  182 => 60,  177 => 59,  174 => 58,  170 => 57,  159 => 51,  155 => 50,  151 => 48,  149 => 47,  146 => 46,  144 => 45,  141 => 44,  136 => 43,  131 => 42,  128 => 41,  124 => 40,  109 => 32,  95 => 25,  87 => 19,  85 => 18,  82 => 17,  78 => 16,  72 => 12,  59 => 9,  54 => 8,  50 => 7,  45 => 5,  42 => 4,  39 => 3,  35 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "section-options.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/section-options.twig");
    }
}
