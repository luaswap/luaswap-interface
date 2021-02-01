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

/* translation-priority-select.twig */
class __TwigTemplate_4f5b1c66e6ef2a2157c93126969313b00b03226b5bfd13452bfdb666be4a5e7a extends \WPML\Core\Twig\Template
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
        echo "<select  class=\"wpml-select2-button js-change-translation-priority\" id=\"icl-st-change-translation-priority-selected\" disabled=\"disabled\">
    <option value=\"\">";
        // line 2
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "empty_text", []));
        echo "</option>
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["translation_priorities"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["translation_priority"]) {
            // line 4
            echo "        <option value=\"";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["translation_priority"], "name", []), "html", null, true);
            echo "\">
            ";
            // line 5
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["translation_priority"], "name", []), "html", null, true);
            echo "
        </option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['translation_priority'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</select>

";
        // line 10
        echo ($context["nonce"] ?? null);
    }

    public function getTemplateName()
    {
        return "translation-priority-select.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 10,  57 => 8,  48 => 5,  43 => 4,  39 => 3,  35 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "translation-priority-select.twig", "/var/www/new/wp-content/plugins/wpml-string-translation/templates/translation-priority/translation-priority-select.twig");
    }
}
