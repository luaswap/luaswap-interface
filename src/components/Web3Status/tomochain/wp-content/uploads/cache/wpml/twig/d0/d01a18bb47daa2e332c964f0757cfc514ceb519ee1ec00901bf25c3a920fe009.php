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

/* pagination.twig */
class __TwigTemplate_18e46a333726925a8edf7b21db789a99404abe581811b4c1d8daff69f7cceab0 extends \WPML\Core\Twig\Template
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
        if ($this->getAttribute(($context["pagination_model"] ?? null), "total_items", [])) {
            // line 2
            echo "
    <h2 class=\"screen-reader-text\">";
            // line 3
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "strings", []), "list_navigation", []), "html", null, true);
            echo "</h2>

    <div class=\"tablenav-pages clearfix\">

        <span class=\"displaying-num\">";
            // line 7
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["pagination_model"] ?? null), "total_items_text", []), "html", null, true);
            echo "</span>

        ";
            // line 9
            if (($this->getAttribute(($context["pagination_model"] ?? null), "total_items", []) > $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "pagination", []), "get_items_per_page", []))) {
                // line 10
                echo "
        <span class=\"pagination-links\">

            ";
                // line 13
                $this->loadTemplate("table-nav-arrow.twig", "pagination.twig", 13)->display(twig_array_merge($context, ["url" => $this->getAttribute($this->getAttribute(                // line 15
($context["pagination_model"] ?? null), "pagination", []), "get_first_page_url", []), "class" => "first-page", "label" => $this->getAttribute($this->getAttribute(                // line 17
($context["pagination_model"] ?? null), "strings", []), "first_page", [])]));
                // line 20
                echo "
            ";
                // line 21
                $this->loadTemplate("table-nav-arrow.twig", "pagination.twig", 21)->display(twig_array_merge($context, ["url" => $this->getAttribute($this->getAttribute(                // line 23
($context["pagination_model"] ?? null), "pagination", []), "get_previous_page_url", []), "class" => "previous-page", "label" => $this->getAttribute($this->getAttribute(                // line 25
($context["pagination_model"] ?? null), "strings", []), "previous_page", [])]));
                // line 28
                echo "
            <span class=\"paging-input\">
                ";
                // line 30
                if ((($context["nav_location"] ?? null) == "top")) {
                    // line 31
                    echo "                    <label for=\"current-page-selector-";
                    echo \WPML\Core\twig_escape_filter($this->env, ($context["nav_location"] ?? null), "html", null, true);
                    echo "\" class=\"screen-reader-text\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "strings", []), "current_page", []), "html", null, true);
                    echo "</label>
                    <input class=\"current-page\" id=\"current-page-selector-";
                    // line 32
                    echo \WPML\Core\twig_escape_filter($this->env, ($context["nav_location"] ?? null), "html", null, true);
                    echo "\" type=\"text\" name=\"paged\"
                           value=\"";
                    // line 33
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "pagination", []), "get_current_page", []), "html", null, true);
                    echo "\" size=\"";
                    echo \WPML\Core\twig_escape_filter($this->env, \WPML\Core\twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "pagination", []), "get_total_pages", [])), "html", null, true);
                    echo "\" aria-describedby=\"table-paging\">
                    <span class=\"tablenav-paging-text\"> ";
                    // line 34
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "strings", []), "of", []), "html", null, true);
                    echo " <span class=\"total-pages\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "pagination", []), "get_total_pages", []), "html", null, true);
                    echo "</span></span>
                ";
                } else {
                    // line 36
                    echo "                    <span class=\"tablenav-paging-text\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "pagination", []), "get_current_page", []), "html", null, true);
                    echo " ";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "strings", []), "of", []), "html", null, true);
                    echo "
                        <span class=\"total-pages\">";
                    // line 37
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pagination_model"] ?? null), "pagination", []), "get_total_pages", []), "html", null, true);
                    echo "</span>
                    </span>
                ";
                }
                // line 40
                echo "            </span>

            ";
                // line 42
                $this->loadTemplate("table-nav-arrow.twig", "pagination.twig", 42)->display(twig_array_merge($context, ["url" => $this->getAttribute($this->getAttribute(                // line 44
($context["pagination_model"] ?? null), "pagination", []), "get_next_page_url", []), "class" => "next-page", "label" => $this->getAttribute($this->getAttribute(                // line 46
($context["pagination_model"] ?? null), "strings", []), "next_page", [])]));
                // line 49
                echo "

            ";
                // line 51
                $this->loadTemplate("table-nav-arrow.twig", "pagination.twig", 51)->display(twig_array_merge($context, ["url" => $this->getAttribute($this->getAttribute(                // line 53
($context["pagination_model"] ?? null), "pagination", []), "get_last_page_url", []), "class" => "last-page", "label" => $this->getAttribute($this->getAttribute(                // line 55
($context["pagination_model"] ?? null), "strings", []), "last_page", [])]));
                // line 58
                echo "
        </span>

        ";
            }
            // line 62
            echo "
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "pagination.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 62,  126 => 58,  124 => 55,  123 => 53,  122 => 51,  118 => 49,  116 => 46,  115 => 44,  114 => 42,  110 => 40,  104 => 37,  97 => 36,  90 => 34,  84 => 33,  80 => 32,  73 => 31,  71 => 30,  67 => 28,  65 => 25,  64 => 23,  63 => 21,  60 => 20,  58 => 17,  57 => 15,  56 => 13,  51 => 10,  49 => 9,  44 => 7,  37 => 3,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "pagination.twig", "/var/www/new/wp-content/plugins/sitepress-multilingual-cms/templates/pagination/pagination.twig");
    }
}
