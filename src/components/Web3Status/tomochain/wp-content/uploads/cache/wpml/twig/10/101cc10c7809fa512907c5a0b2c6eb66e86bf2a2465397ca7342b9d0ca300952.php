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

/* template.twig */
class __TwigTemplate_270bdc5e31d52576031d1f5e281531133a135edef5c16123b0cd18ba2013597c extends \WPML\Core\Twig\Template
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
        $context["current_language"] = $this->getAttribute(($context["languages"] ?? null), ($context["current_language_code"] ?? null), [], "array");
        // line 2
        $context["css_classes_flag"] = \WPML\Core\twig_trim_filter(("wpml-ls-flag " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_flag", [])));
        // line 3
        $context["css_classes_native"] = \WPML\Core\twig_trim_filter(("wpml-ls-native " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_native", [])));
        // line 4
        $context["css_classes_display"] = \WPML\Core\twig_trim_filter(("wpml-ls-display " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_display", [])));
        // line 5
        $context["css_classes_bracket"] = \WPML\Core\twig_trim_filter(("wpml-ls-bracket " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_bracket", [])));
        // line 6
        echo "
<div
\t class=\"";
        // line 8
        echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes"] ?? null), "html", null, true);
        echo " wpml-ls-legacy-dropdown js-wpml-ls-legacy-dropdown\"";
        if ($this->getAttribute(($context["backward_compatibility"] ?? null), "css_id", [])) {
            echo " id=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["backward_compatibility"] ?? null), "css_id", []), "html", null, true);
            echo "\"";
        }
        echo ">
\t<ul>

\t\t<li tabindex=\"0\" class=\"";
        // line 11
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["current_language"] ?? null), "css_classes", []), "html", null, true);
        echo " wpml-ls-item-legacy-dropdown\">
\t\t\t<a href=\"#\" class=\"";
        // line 12
        echo \WPML\Core\twig_escape_filter($this->env, \WPML\Core\twig_trim_filter(("js-wpml-ls-item-toggle wpml-ls-item-toggle " . $this->getAttribute($this->getAttribute(($context["current_language"] ?? null), "backward_compatibility", []), "css_classes_a", []))), "html", null, true);
        echo "\">";
        // line 13
        if ($this->getAttribute(($context["current_language"] ?? null), "flag_url", [])) {
            // line 14
            echo "<img class=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_flag"] ?? null), "html", null, true);
            echo "\" src=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["current_language"] ?? null), "flag_url", []), "html", null, true);
            echo "\" alt=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["current_language"] ?? null), "flag_alt", []), "html", null, true);
            echo "\">";
        }
        // line 17
        if (($this->getAttribute(($context["current_language"] ?? null), "display_name", []) || $this->getAttribute(($context["current_language"] ?? null), "native_name", []))) {
            // line 18
            $context["current_language_name"] = (($this->getAttribute(($context["current_language"] ?? null), "display_name", [], "any", true, true)) ? (\WPML\Core\_twig_default_filter($this->getAttribute(($context["current_language"] ?? null), "display_name", []), $this->getAttribute(($context["current_language"] ?? null), "native_name", []))) : ($this->getAttribute(($context["current_language"] ?? null), "native_name", [])));
            // line 19
            echo "<span class=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_native"] ?? null), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["current_language_name"] ?? null), "html", null, true);
            echo "</span>";
        }
        // line 21
        echo "</a>

\t\t\t<ul class=\"wpml-ls-sub-menu\">
\t\t\t\t";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            if ( !$this->getAttribute($context["language"], "is_current", [])) {
                // line 25
                echo "
\t\t\t\t\t<li class=\"";
                // line 26
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "css_classes", []), "html", null, true);
                echo "\">
\t\t\t\t\t\t<a href=\"";
                // line 27
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "url", []), "html", null, true);
                echo "\" class=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_link"] ?? null), "html", null, true);
                echo "\">";
                // line 28
                if ($this->getAttribute($context["language"], "flag_url", [])) {
                    // line 29
                    echo "<img class=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_flag"] ?? null), "html", null, true);
                    echo "\" src=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "flag_url", []), "html", null, true);
                    echo "\" alt=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "flag_alt", []), "html", null, true);
                    echo "\">";
                }
                // line 32
                if ($this->getAttribute($context["language"], "native_name", [])) {
                    // line 33
                    echo "<span class=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_native"] ?? null), "html", null, true);
                    echo "\" lang=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "code", []), "html", null, true);
                    echo "\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "native_name", []), "html", null, true);
                    echo "</span>";
                }
                // line 35
                if ($this->getAttribute($context["language"], "display_name", [])) {
                    // line 36
                    echo "<span class=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_display"] ?? null), "html", null, true);
                    echo "\">";
                    // line 37
                    if ($this->getAttribute($context["language"], "native_name", [])) {
                        echo "<span class=\"";
                        echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_bracket"] ?? null), "html", null, true);
                        echo "\"> (</span>";
                    }
                    // line 38
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["language"], "display_name", []), "html", null, true);
                    // line 39
                    if ($this->getAttribute($context["language"], "native_name", [])) {
                        echo "<span class=\"";
                        echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_bracket"] ?? null), "html", null, true);
                        echo "\">)</span>";
                    }
                    // line 40
                    echo "</span>";
                }
                // line 42
                echo "</a>
\t\t\t\t\t</li>

\t\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "\t\t\t</ul>

\t\t</li>

\t</ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 46,  154 => 42,  151 => 40,  145 => 39,  143 => 38,  137 => 37,  133 => 36,  131 => 35,  122 => 33,  120 => 32,  111 => 29,  109 => 28,  104 => 27,  100 => 26,  97 => 25,  92 => 24,  87 => 21,  80 => 19,  78 => 18,  76 => 17,  67 => 14,  65 => 13,  62 => 12,  58 => 11,  46 => 8,  42 => 6,  40 => 5,  38 => 4,  36 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "template.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/legacy-dropdown/template.twig");
    }
}
