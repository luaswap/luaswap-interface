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
class __TwigTemplate_b86155c4fb45269ad52dc23dc17883e0c2c687f960b4761101a63216ff4d49a5 extends \WPML\Core\Twig\Template
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
        $context["css_classes_flag"] = \WPML\Core\twig_trim_filter(("wpml-ls-flag " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_flag", [])));
        // line 2
        $context["css_classes_native"] = \WPML\Core\twig_trim_filter(("wpml-ls-native " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_native", [])));
        // line 3
        $context["css_classes_display"] = \WPML\Core\twig_trim_filter(("wpml-ls-display " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_display", [])));
        // line 4
        $context["css_classes_bracket"] = \WPML\Core\twig_trim_filter(("wpml-ls-bracket " . $this->getAttribute(($context["backward_compatibility"] ?? null), "css_classes_bracket", [])));
        // line 6
        if (($context["flag_url"] ?? null)) {
            // line 7
            echo "<img class=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_flag"] ?? null), "html", null, true);
            echo "\" src=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["flag_url"] ?? null), "html", null, true);
            echo "\" alt=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["flag_alt"] ?? null), "html", null, true);
            echo "\">";
        }
        // line 10
        if (($context["native_name"] ?? null)) {
            // line 11
            echo "<span class=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_native"] ?? null), "html", null, true);
            echo "\" lang=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["code"] ?? null), "html", null, true);
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["native_name"] ?? null), "html", null, true);
            echo "</span>";
        }
        // line 14
        if (($context["display_name"] ?? null)) {
            // line 15
            echo "<span class=\"";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_display"] ?? null), "html", null, true);
            echo "\">";
            // line 16
            if (($context["native_name"] ?? null)) {
                echo "<span class=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_bracket"] ?? null), "html", null, true);
                echo "\"> (</span>";
            }
            // line 17
            echo \WPML\Core\twig_escape_filter($this->env, ($context["display_name"] ?? null), "html", null, true);
            // line 18
            if (($context["native_name"] ?? null)) {
                echo "<span class=\"";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["css_classes_bracket"] ?? null), "html", null, true);
                echo "\">)</span>";
            }
            // line 19
            echo "</span>";
        }
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
        return array (  82 => 19,  76 => 18,  74 => 17,  68 => 16,  64 => 15,  62 => 14,  53 => 11,  51 => 10,  42 => 7,  40 => 6,  38 => 4,  36 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set css_classes_flag    = ('wpml-ls-flag ' ~ backward_compatibility.css_classes_flag)|trim %}
{% set css_classes_native  = ('wpml-ls-native ' ~ backward_compatibility.css_classes_native)|trim %}
{% set css_classes_display = ('wpml-ls-display ' ~ backward_compatibility.css_classes_display)|trim %}
{% set css_classes_bracket = ('wpml-ls-bracket ' ~ backward_compatibility.css_classes_bracket)|trim %}

{%- if flag_url -%}
    <img class=\"{{ css_classes_flag }}\" src=\"{{ flag_url }}\" alt=\"{{ flag_alt }}\">
{%- endif -%}

{%- if native_name -%}
    <span class=\"{{ css_classes_native }}\" lang=\"{{ code }}\">{{ native_name }}</span>
{%- endif -%}

{%- if display_name -%}
    <span class=\"{{ css_classes_display }}\">
    {%- if native_name -%}<span class=\"{{ css_classes_bracket }}\"> (</span>{%- endif -%}
        {{- display_name -}}
        {%- if native_name -%}<span class=\"{{ css_classes_bracket }}\">)</span>{%- endif -%}
    </span>
{%- endif -%}
", "template.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/menu-item/template.twig");
    }
}
