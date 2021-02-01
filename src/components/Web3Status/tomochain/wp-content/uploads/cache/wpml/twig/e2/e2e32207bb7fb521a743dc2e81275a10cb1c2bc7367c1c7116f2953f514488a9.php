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

/* slot-subform-statics-post_translations.twig */
class __TwigTemplate_5ab4d286cd508e3c1ecd995c7657483e71944e8ac0c3813880f4cbf50680144b extends \WPML\Core\Twig\Template
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
        $this->loadTemplate("preview.twig", "slot-subform-statics-post_translations.twig", 1)->display(twig_array_merge($context, ["preview" => $this->getAttribute($this->getAttribute(($context["previews"] ?? null), "statics", []), "post_translations", [])]));
        // line 2
        echo "
<div class=\"wpml-ls-subform-options\">

\t";
        // line 5
        $this->loadTemplate("dropdown-templates.twig", "slot-subform-statics-post_translations.twig", 5)->display(twig_array_merge($context, ["id" => "in-post-translations", "name" => "statics[post_translations][template]", "value" => $this->getAttribute($this->getAttribute($this->getAttribute(        // line 9
($context["settings"] ?? null), "statics", []), "post_translations", []), "template", []), "slot_type" => "post_translations"]));
        // line 13
        echo "
\t";
        // line 14
        $this->loadTemplate("checkboxes-includes.twig", "slot-subform-statics-post_translations.twig", 14)->display(twig_array_merge($context, ["name_base" => "statics[post_translations]", "slot_settings" => $this->getAttribute($this->getAttribute(        // line 17
($context["settings"] ?? null), "statics", []), "post_translations", []), "template_slug" => $this->getAttribute(        // line 18
($context["slot_settings"] ?? null), "template", [])]));
        // line 21
        echo "
\t<h4><label>";
        // line 22
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "position_label", []), "html", null, true);
        echo "</label>  ";
        $this->loadTemplate("tooltip.twig", "slot-subform-statics-post_translations.twig", 22)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "post_translation_position", [])]));
        echo "</h4>
\t<ul>
\t\t<li>
\t\t\t<label>
\t\t\t\t<input type=\"checkbox\" name=\"statics[post_translations][display_before_content]\"
\t\t\t\t\t   id=\"wpml-ls-before-in-post-translations\"
\t\t\t\t\t   value=\"1\"";
        // line 28
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", []), "display_before_content", [])) {
            echo " checked=\"checked\"";
        }
        echo ">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "position_above", []), "html", null, true);
        echo "
\t\t\t</label>
\t\t</li>
\t\t<li>
\t\t\t<label>
\t\t\t\t<input type=\"checkbox\"  name=\"statics[post_translations][display_after_content]\"
\t\t\t\t\t   id=\"wpml-ls-after-in-post-translations\"
\t\t\t\t\t   value=\"1\"";
        // line 35
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", []), "display_after_content", [])) {
            echo " checked=\"checked\"";
        }
        echo ">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "position_below", []), "html", null, true);
        echo "
\t\t\t</label>
\t\t</li>
\t</ul>

\t";
        // line 40
        if (twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", []), "availability_text", []))) {
            // line 41
            echo "\t\t";
            $context["availability_text"] = $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "default_alternative_languages_text", []);
            // line 42
            echo "\t";
        } else {
            // line 43
            echo "\t\t";
            $context["availability_text"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", []), "availability_text", []);
            // line 44
            echo "\t";
        }
        // line 45
        echo "
\t<h4><label>";
        // line 46
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "label_alternative_languages_text", []), "html", null, true);
        echo "</label>  ";
        $this->loadTemplate("tooltip.twig", "slot-subform-statics-post_translations.twig", 46)->display(twig_array_merge($context, ["content" => $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "tooltips", []), "alternative_languages_text", [])]));
        echo "</h4>
\t<input type=\"text\" class=\"js-wpml-ls-trigger-update\"
\t\t   name=\"statics[post_translations][availability_text]\" value=\"";
        // line 48
        echo \WPML\Core\twig_escape_filter($this->env, ($context["availability_text"] ?? null), "html", null, true);
        echo "\" size=\"40\">

</div>";
    }

    public function getTemplateName()
    {
        return "slot-subform-statics-post_translations.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 48,  106 => 46,  103 => 45,  100 => 44,  97 => 43,  94 => 42,  91 => 41,  89 => 40,  77 => 35,  63 => 28,  52 => 22,  49 => 21,  47 => 18,  46 => 17,  45 => 14,  42 => 13,  40 => 9,  39 => 5,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "slot-subform-statics-post_translations.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/slot-subform-statics-post_translations.twig");
    }
}
