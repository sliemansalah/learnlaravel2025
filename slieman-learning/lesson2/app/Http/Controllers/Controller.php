<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Laravel Lesson 2 - Routing API Documentation",
 *     description="Complete API documentation for all routes in Lesson 2 practice application",
 *     @OA\Contact(
 *         email="student@example.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Development Server"
 * )
 *
 * @OA\Get(
 *     path="/",
 *     summary="Home Page",
 *     description="Display the welcome page",
 *     tags={"Home"},
 *     @OA\Response(
 *         response=200,
 *         description="Welcome page displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/test/{id}/{slug}",
 *     summary="Test Route with Parameters",
 *     description="Test route with ID and slug parameters",
 *     tags={"Test"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Numeric ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Slug string",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns ID and slug"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/products",
 *     summary="Get Products List",
 *     description="Display list of all products",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="Products list displayed"
 *     )
 * )
 *
 * @OA\Post(
 *     path="/products",
 *     summary="Create New Product",
 *     description="Create a new product",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="Product created successfully"
 *     )
 * )
 *
 * @OA\Put(
 *     path="/products/{id}",
 *     summary="Update Product",
 *     description="Update a product completely",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Product ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated successfully"
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/products/{id}",
 *     summary="Delete Product",
 *     description="Delete a product",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Product ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted successfully"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/product/{id}",
 *     summary="Get Product by ID",
 *     description="Display a specific product by numeric ID",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Product ID (numbers only)",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product details displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/products/{slug}",
 *     summary="Get Product by Slug",
 *     description="Display a product by slug",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         description="Product slug (lowercase letters, numbers, hyphens)",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/user/{name}",
 *     summary="User Greeting",
 *     description="Display greeting message for user (optional name parameter)",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="name",
 *         in="path",
 *         description="User name (optional, defaults to 'Guest')",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Greeting message displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/category/{category}/product/{product}",
 *     summary="Get Product by Category",
 *     description="Display product within a specific category",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="category",
 *         in="path",
 *         description="Category name",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="product",
 *         in="path",
 *         description="Product name",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category and product displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/dashboard",
 *     summary="Dashboard",
 *     description="Display user dashboard",
 *     tags={"Dashboard"},
 *     @OA\Response(
 *         response=200,
 *         description="Dashboard displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/profile",
 *     summary="User Profile",
 *     description="Display user profile page",
 *     tags={"Users"},
 *     @OA\Response(
 *         response=200,
 *         description="Profile page displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/admin/dashboard",
 *     summary="Admin Dashboard",
 *     description="Display admin dashboard",
 *     tags={"Admin"},
 *     @OA\Response(
 *         response=200,
 *         description="Admin dashboard displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/admin/users",
 *     summary="Admin - Manage Users",
 *     description="Display user management page",
 *     tags={"Admin"},
 *     @OA\Response(
 *         response=200,
 *         description="User management page displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/admin/products",
 *     summary="Admin - Manage Products",
 *     description="Display product management page",
 *     tags={"Admin"},
 *     @OA\Response(
 *         response=200,
 *         description="Product management page displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/admin/settings",
 *     summary="Admin - Settings",
 *     description="Display admin settings page",
 *     tags={"Admin"},
 *     @OA\Response(
 *         response=200,
 *         description="Settings page displayed"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/contact",
 *     summary="Contact Form",
 *     description="Display contact form",
 *     tags={"Contact"},
 *     @OA\Response(
 *         response=200,
 *         description="Contact form displayed"
 *     )
 * )
 *
 * @OA\Post(
 *     path="/contact",
 *     summary="Submit Contact Form",
 *     description="Process contact form submission",
 *     tags={"Contact"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 required={"name", "email", "message"},
 *                 @OA\Property(property="name", type="string", description="User name"),
 *                 @OA\Property(property="email", type="string", format="email", description="User email"),
 *                 @OA\Property(property="message", type="string", description="Message content")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=302,
 *         description="Redirect to contact form with success message"
 *     )
 * )
 */
abstract class Controller
{
    //
}
