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

/* section-post-translations.twig */
class __TwigTemplate_379b0a06b358c43c0bce965f6d507f8309e0757044f372cd6d5f0a12dbbb4481 extends \WPML\Core\Twig\Template
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
        echo "<p class=\"wpml-ls-form-line js-wpml-ls-option\">
    <label for=\"wpml-ls-show-in-post-translations\">
        <input type=\"checkbox\" id=\"wpml-ls-show-in-post-translations\" name=\"statics[post_translations][show]\" value=\"1\"
               class=\"js-wpml-ls-toggle-slot js-wpml-ls-trigger-save\" data-target=\".js-wpml-ls-post-translations-toggle-target\"
               ";
        // line 5
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", []), "show", [])) {
            echo "checked=\"checked\"";
        }
        echo "/>
        ";
        // line 6
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "post_translations", []), "show", []), "html", null, true);
        echo "
    </label>

    ";
        // line 9
        $this->loadTemplate("save-notification.twig", "section-post-translations.twig", 9)->display($context);
        // line 10
        echo "</p>

<div class=\"js-wpml-ls-post-translations-toggle-target alignleft";
        // line 12
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", []), "show", []) != 1)) {
            echo " hidden";
        }
        echo "\">

    ";
        // line 14
        $context["slot_settings"] = [];
        // line 15
        echo "    ";
        $context["slot_settings"] = \WPML\Core\twig_array_merge(($context["slot_settings"] ?? null), ["post_translations" => $this->getAttribute($this->getAttribute(($context["settings"] ?? null), "statics", []), "post_translations", [])]);
        // line 16
        echo "
    ";
        // line 17
        $this->loadTemplate("table-slots.twig", "section-post-translations.twig", 17)->display(twig_array_merge($context, ["slot_type" => "statics", "slots_settings" =>         // line 20
($context["slot_settings"] ?? null), "slug" => "post_translations"]));
        // line 24
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "section-post-translations.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 24,  72 => 20,  71 => 17,  68 => 16,  65 => 15,  63 => 14,  56 => 12,  52 => 10,  50 => 9,  44 => 6,  38 => 5,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "section-post-translations.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/section-post-translations.twig");
    }
}
