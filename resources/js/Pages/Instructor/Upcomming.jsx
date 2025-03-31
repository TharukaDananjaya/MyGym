import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router } from "@inertiajs/react";

export default function Upcoming({ scheduledClasses }) {
    const onCancel = (classItem) =>{
        confirm(
            "Are you sure you want to cancel this class?"
        ) && router.delete(route('schedule.destroy', classItem))
    }
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Upcoming Classes
                </h2>
            }
        >
            <Head title="Upcoming Classes" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-10 text-gray-900 max-w-2xl divide-y">
                            {scheduledClasses.length > 0 ? (
                                scheduledClasses.map((classItem) => (
                                    <div key={classItem.id} className="py-6">
                                        <div className="flex gap-6 justify-between">
                                            <div>
                                                <p className="text-2xl font-bold text-purple-700">
                                                    {classItem.class_type.name}
                                                </p>
                                                <span className="text-slate-600 text-sm">
                                                    {
                                                        classItem.class_type
                                                            .minuts
                                                    }{" "}
                                                    minutes
                                                </span>
                                            </div>
                                            <div className="text-right flex-shrink-0">
                                                <p className="text-lg font-bold">
                                                    {new Date(
                                                        classItem.date_time
                                                    ).toLocaleTimeString([], {
                                                        hour: "numeric",
                                                        minute: "2-digit",
                                                    })}
                                                </p>
                                                <p className="text-sm">
                                                    {new Date(
                                                        classItem.date_time
                                                    ).toLocaleDateString([], {
                                                        day: "numeric",
                                                        month: "short",
                                                    })}
                                                </p>
                                            </div>
                                        </div>
                                        <div className="mt-1 text-right">
                                            <button className="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" onClick={()=> onCancel(classItem)}>
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div>
                                    <p>You don't have any upcoming classes</p>
                                    <a
                                        className="inline-block mt-6 underline text-sm text-blue-600 hover:text-blue-800"
                                        href="/schedule/create"
                                    >
                                        Schedule now
                                    </a>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
