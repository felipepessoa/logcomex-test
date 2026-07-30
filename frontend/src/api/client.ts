import type {RouteDefinition} from "../generated/controllers";

type RouteResult = {
    url: string
    method: string
}

export async function request<T>(route: RouteResult, body?:unknown): Promise<T> {
    const url = route.url.startsWith('/') ? route.url : `/${route.url}`
    const response = await fetch(url, {
        method: route.method.toUpperCase(),
        headers: body ? { 'Content-Type': 'application/json' } : undefined,
        body: body ? JSON.stringify(body) : undefined
    })
    if(!response.ok) {
        const error = await response.json().catch(() =>({}))
        throw new Error(
            (error as {message?: string}).message ?? `Erro HTTP status: ${response.status}`
        )
    }
    return response.json() as Promise<T>
}

export async function uploadRoute<T>(route: RouteDefinition, formData: FormData): Promise<T> {
    const url = route.url.startsWith('/') ? route.url : `/${route.url}`
    const response = await fetch(url, {
        method: route.method.toUpperCase(),
        body: formData
    })
    if(!response.ok) {
        const error = await response.json().catch(() =>({}))
        throw new Error(
            (error as {message?: string}).message ?? `Erro HTTP status: ${response.status}`
        )
    }
    return response.json() as Promise<T>
}