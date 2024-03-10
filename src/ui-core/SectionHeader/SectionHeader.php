<?php

namespace Devinci\UICore\SectionHeader;

class SectionHeader
{
    private $title;
    private $lastModified;
    private $breadcrumb;
    private $breadcrumbUrl;

    public function __construct($title, $lastModified, $breadcrumb, $breadcrumbUrl = [])
    {
        $this->title = $title;
        $this->lastModified = $lastModified;
        $this->breadcrumb = $breadcrumb;
        $this->breadcrumbUrl = $breadcrumbUrl;
    }

    /**
     * @param array|mixed $breadcrumbUrls
     */
    public function setBreadcrumbUrl(mixed $breadcrumbUrl): void
    {
        $this->breadcrumbUrl = $breadcrumbUrl;
    }


    /**
     * @return mixed
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param mixed $lastModified
     */
    public function setLastModified($lastModified): void
    {
        $this->lastModified = $lastModified;
    }

    /**
     * @return mixed
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * @param mixed $breadcrumb
     */
    public function setBreadcrumb($breadcrumb): void
    {
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function render()
    {
        $html = '<div class="header">';

        // Title
        $html .= '<span><h1 class="title-medium-text">' . htmlspecialchars($this->title) . '</h1>';

        // Timestamp last modified
//        $html .= '<div class=" caption-text last-modified">Last Modified: ' . htmlspecialchars($this->lastModified) . '</div></span>';

        // Breadcrumb
        $html .= '<nav class="caption-text breadcrumb">' . $this->renderBreadcrumb() . '</nav>';

        $html .= '</div>';

        return $html;
    }

    private function renderBreadcrumb()
    {
        $breadcrumbHtml = '';

        if (!empty($this->breadcrumb) && is_array($this->breadcrumb)) {
            foreach ($this->breadcrumb as $index => $crumb) {
                $isLastCrumb = $index === count($this->breadcrumb) - 1;

                // Generate link for each breadcrumb item
                if (isset($this->breadcrumbUrls[$index]) && $this->breadcrumbUrls[$index] !== null) {
                    $breadcrumbHtml .= $isLastCrumb
                        ? '<span class="breadcrumb-item">' . htmlspecialchars($crumb) . '</span>'
                        : '<a href="' . htmlspecialchars($this->breadcrumbUrls[$index]) . '" class="breadcrumb-item">' . htmlspecialchars($crumb) . '</a>';
                } else {
                    $breadcrumbHtml .= '<span class="breadcrumb-item">' . htmlspecialchars($crumb) . '</span>';
                }

                // Add separator if not the last breadcrumb
                if (!$isLastCrumb) {
                    $breadcrumbHtml .= ' › ';
                }
            }
        }

        return $breadcrumbHtml;
    }
}
